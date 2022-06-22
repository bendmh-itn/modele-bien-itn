<?php

$uri = $_SERVER['REQUEST_URI'];


if ($uri === '/index.php' || $uri === '/') {

    //Partie page principale
    $biens = selectAllBiens($pdo);
    $jumbotron = "Liste de tous les biens";
    require_once "templates/biens/listBiens.php";
} elseif (isset($_GET["surfaceMinimum"]) || isset($_GET["surfaceMaximum"]) || isset($_GET["prixMinimum"]) || isset($_GET["prixMaximum"])) {
    //Partie page principale
    $biens = selectBiensFiltres($pdo);
    $jumbotron = "Liste des biens filtrés";
    require_once "templates/biens/listBiens.php";
} elseif ($uri === '/index.php?/templates/mesBiens') {
    //Partie page principale
    $biens = selectMesBiens($pdo);
    $jumbotron = "Liste de tous vos biens";
    require_once "templates/biens/listBiens.php";
} elseif ($uri === '/index.php?/templates/createBien.php') {
    //Partie traitement d'événements
    if (isset($_POST["btnEnvoi"])) {
        if ($_POST["txtNom"] && $_POST["txtTaille"] && $_POST["txtPrice"] && $_POST["txtVille"] && $_POST["txtDescription"] && $_POST["txtChambres"]) {
            if (verifData($_POST["txtPrice"], "txtPrice") && verifData($_POST["txtTaille"], "txtTaille") && verifData($_POST["txtChambres"], "txtChambres")) {
                createBien($pdo);
                $bienId = $pdo->lastInsertId();
                if (!empty($_FILES["imageDefault"]["name"])) {
                    addImagesInDataBase($pdo, $bienId);
                }
                if (isset($_POST["selectElements"])) {
                    $countfiles = count($_POST["selectElements"]);
                    for ($i = 0; $i < $countfiles; $i++) {
                        insertOptionsInBien($pdo, $_POST["selectElements"][$i], $bienId);
                    }
                }
                $_SESSION['flashMessage'] = "Votre bien a été créé";
                $_SESSION['flashColor'] = "success";
                header('Location:/index.php?action=modify&bienId=' . $bienId);
            }
        } else {
            $_SESSION['flashMessage'] = "Un ou plusieurs champs ne sont pas complétés";
            $_SESSION['flashColor'] = "danger";
        }
    }
    //Partie page principale
    $errorTxtPrice = isset($_SESSION["txtPrice"]) ? $_SESSION["txtPrice"] : null;
    $errorTxtTaille = isset($_SESSION["txtTaille"]) ? $_SESSION["txtTaille"] : null;
    $errorTxtChambres = isset($_SESSION["txtChambres"]) ? $_SESSION["txtChambres"] : null;
    unset($_SESSION["txtPrice"]);
    unset($_SESSION["txtTaille"]);
    unset($_SESSION["txtChambres"]);
    $message = "Ajouter un bien";
    $button = "Ajouter";
    $allOptions = selectAllOptions($pdo);
    $jumbotron = "Créer un bien";
    require_once "templates/biens/newOrEditBien.php";
} elseif (isset($_GET['bienId']) && isset($_GET['action']) && $_GET['action'] == "show") {
    //Partie page principale
    $bien = selectOneBien($pdo);
    $images = selectImagesOfBien($pdo);
    $jumbotron = "Présentation du bien";
    $options = selectOptionsOfBien($pdo);
    require_once "templates/biens/showBien.php";
} elseif (isset($_GET['bienId']) && isset($_GET['action']) && $_GET['action'] == "modify") {
    //Partie traitement d'événements
    if (!verifDroitDeleteAndModify($pdo, $_GET['bienId'])) {
        header('Location:/index.php/pageNotFound.php');
    } else {
        if (isset($_POST["btnEnvoi"])) {
            if ($_POST["txtNom"] && $_POST["txtTaille"] && $_POST["txtPrice"] && $_POST["txtVille"] && $_POST["txtDescription"] && $_POST["txtChambres"]) {
                editerBien($pdo);
                if (!empty($_FILES["imageDefault"]["name"])) {
                    addImagesInDataBase($pdo, $_GET['bienId']);
                }
                if (isset($_POST["selectElements"])) {
                    deleteAllOptionsOfBien($pdo);
                    $countfiles = count($_POST["selectElements"]);
                    for ($i = 0; $i < $countfiles; $i++) {
                        insertOptionsInBien($pdo, $_POST["selectElements"][$i], $_GET['bienId']);
                    }
                }
                $_SESSION['flashMessage'] = "Votre bien a été modifié";
                $_SESSION['flashColor'] = "success";
            } else {
                $_SESSION['flashMessage'] = "Un ou plusieurs champs ne sont pas complétés";
                $_SESSION['flashColor'] = "danger";
            }
        }

        if (isset($_POST["btnEnvoiImage"])) {
            if (!empty($_FILES["image"]["name"])) {
                addImagesInDataBase($pdo, $_GET['bienId'], 'image');
            } else {
                $_SESSION['flashMessage'] = "Selectionne un fichier à télécharger";
                $_SESSION['flashColor'] = "danger";
            }
        }


        //Partie page principale
        $jumbotron = "Modifier ce bien";
        $message = "Modifier votre bien";
        $button = "Modifier";
        $bien = selectOneBien($pdo);
        $images = selectImagesOfBien($pdo);
        $allOptions = selectAllOptions($pdo);
        $optionsBien = selectOptionsOfBien($pdo);
        require_once "templates/biens/newOrEditBien.php";
    }
} elseif (isset($_GET['imageIdDelete'])) {
    //Partie page principale
    deleteImage($pdo);
    $_SESSION['flashMessage'] = "L'image a été supprimée";
    $_SESSION['flashColor'] = "success";
    header('Location:/index.php?action=modify&bienId=' . $_GET['bienId']);
} elseif (isset($_GET['imageDefaultIdDelete'])) {
    //Partie page principale
    addOrDeleteDefaultImageToBien($pdo, NULL,  $_GET['imageDefaultIdDelete']);
    $_SESSION['flashMessage'] = "L'image a été supprimée";
    $_SESSION['flashColor'] = "success";
    header('Location:/index.php?bienId=' . $_GET['imageDefaultIdDelete']);
} elseif (isset($_GET['bienId']) && isset($_GET['action']) && $_GET['action'] == "delete") {
    //Partie traitement d'événements
    if (!verifDroitDeleteAndModify($pdo, $_GET['bienId'])) {
        header('Location:/index.php/pageNotFound.php');
    } else {
        deleteAllOptionsOfBien($pdo);
        deleteAllImageOfbien($pdo);
        deleteBien($pdo);
        $_SESSION['flashMessage'] = "Votre bien a été supprimé";
        $_SESSION['flashColor'] = "success";
        header('Location:/index.php?/templates/mesBiens.php');
    }
} elseif ($uri == '/index.php/pageNotFound.php') {
    //Partie page principale
    require_once "templates/pageNotFound.php";
}

/**
 * Fonction permettant d'ajouter ou modifier la photo par défaut d'un bien
 *
 * @param PDO $pdo
 * @param string $action
 * @param int $bienId
 * @return void
 */
function addImagesInDataBase($pdo, $bienId, $action = "imageDefault")
{
    $countfiles = count($_FILES[$action]['name']);
    // Get file info 
    for ($i = 0; $i < $countfiles; $i++) {
        $randomNombre = rand(1, 9999);
        if ($action == 'imageDefault') {
            $fileName = $randomNombre . '' . $_FILES[$action]["name"];
            $tmpPath = $_FILES[$action]['tmp_name'];
        } else {
            $fileName = $randomNombre . '' . $_FILES[$action]["name"][$i];
            $tmpPath = $_FILES[$action]['tmp_name'][$i];
        }

        $target_file = 'images/DB/' . $fileName;
        $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        // Allow certain file formats 
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
        if (in_array($fileType, $allowTypes)) {
            if (move_uploaded_file(
                $tmpPath,
                $target_file
            )) {

                if ($action == 'imageDefault') {
                    $insert = addImageToBien($pdo, $fileName, $target_file);
                    $imageId = $pdo->lastInsertId();
                    $insert = addOrDeleteDefaultImageToBien($pdo, $imageId, $bienId);
                } else {
                    $insert = addImageToBien($pdo, $fileName, $target_file);
                }
                // Execute query
            }

            if ($insert) {
                $_SESSION['flashMessage'] = "Ajout de l'image réussi";
                $_SESSION['flashColor'] = "success";
            } else {
                $_SESSION['flashMessage'] = "Téléchargement raté, essaye à nouveau";
                $_SESSION['flashColor'] = "danger";
            }
        } else {
            $_SESSION['flashMessage'] = "Désolé, uniquement les fichiers jpg, jpeg, png et gif sont autorisés";
            $_SESSION['flashColor'] = "danger";
        }
    }
}

function verifDroitDeleteAndModify($pdo, $bienId)
{
    $biensUser = selectMesBiens($pdo);
    foreach ($biensUser as $bienUser) {
        if ($bienUser->bienId === $bienId) {
            return true;
        }
    }
    return false;
}

function verifData($data, $key)
{
    if (!is_numeric($data)) {
        $_SESSION[$key] = "*Un nombre est demandé";
        return false;
    };
    return true;
}
