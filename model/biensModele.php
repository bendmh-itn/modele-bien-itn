<?php

/**
 * Fonction permettant de récupérer tous les biens du site
 *
 * @param PDO $pdo
 * @return $biens
 */
function selectAllBiens($pdo)
{
    try {
        $query = "SELECT * FROM `biens` LEFT JOIN images on biens.imageBien = images.id";
        $ajoute = $pdo->prepare($query);
        $ajoute->execute();
        $biens = $ajoute->fetchAll();
        return $biens;
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}

/**
 * Fonction permettant de récupérer les biens de la personne connectée
 *
 * @param PDO $pdo
 * @return $biens
 */
function selectMesBiens($pdo)
{
    try {
        $query = "SELECT * FROM `biens` LEFT JOIN images on biens.imageBien = images.id where userId=:userConnected";
        $ajoute = $pdo->prepare($query);
        $ajoute->execute([
            'userConnected' => $_SESSION['user']->id
        ]);
        $biens = $ajoute->fetchAll();
        return $biens;
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}

/**
 * Cette fonction permet de récupérer les biens selon les filtres souhaités
 *
 * @param PDO $pdo
 * @return void
 */
function selectBiensFiltres($pdo)
{
    $query = "SELECT * FROM `biens` LEFT JOIN images on biens.imageBien = images.id where ";
    $tabExecute = [];
    if ($_GET["surfaceMinimum"]) {
        $query = $query . "taille > :tailleMin";
        $tabExecute['tailleMin'] = htmlentities($_GET["surfaceMinimum"]);
    } else {
        $query = $query . "taille > :tailleMin";
        $tabExecute['tailleMin'] = 0;
    }
    if ($_GET["surfaceMaximum"]) {
        $query = $query . " and taille < :tailleMax";
        $tabExecute['tailleMax'] = htmlentities($_GET["surfaceMaximum"]);
    }
    if ($_GET["prixMinimum"]) {
        $query = $query . " and prix > :prixMin";
        $tabExecute['prixMin'] = htmlentities($_GET["prixMinimum"]);
    }
    if ($_GET["prixMaximum"]) {
        $query = $query . " and prix < :prixMax";
        $tabExecute['prixMax'] = htmlentities($_GET["prixMaximum"]);
    }
    $ajoute = $pdo->prepare($query);
    $ajoute->execute($tabExecute);
    $biens = $ajoute->fetchAll();
    return $biens;
}

/**
 * Fonction permettant de récupérer un bien pour le modifier
 *
 * @param PDO $pdo
 * @return $bien
 */
function selectOneBien($pdo)
{
    try {
        $query = "SELECT * FROM `biens` LEFT JOIN images on biens.imageBien = images.id where biens.bienId=:bienId";
        $ajoute = $pdo->prepare($query);
        $ajoute->execute([
            'bienId' => $_GET['bienId']
        ]);
        $bien = $ajoute->fetch();
        return $bien;
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}


/**
 * Fonction qui edit le bien souhaité
 *
 * @param PDO $pdo
 * @return void
 */
function editerBien($pdo)
{
    try {
        $query = "update biens set nom = :nom, prix = :prix, taille = :taille, ville = :ville, description = :description, chambres = :chambres  where bienId = :bienId";
        $ajoute = $pdo->prepare($query);
        $ajoute->execute([
            'nom' => htmlentities($_POST["txtNom"]),
            'prix' => htmlentities($_POST["txtPrice"]),
            'taille' => htmlentities($_POST["txtTaille"]),
            'ville' => htmlentities($_POST["txtVille"]),
            'bienId' => $_GET["bienId"],
            'description' => htmlentities($_POST["txtDescription"]),
            'chambres' => htmlentities($_POST["txtChambres"])
        ]);
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}

/**
 * Fonction permettant de créer un bien
 *
 * @param PDO $pdo
 * @return void
 */
function createBien($pdo)
{
    try {
        $query = "insert into biens (nom, taille, prix, ville, userId, description, chambres) values (:nom, :taille, :prix, :ville, :userId, :description, :chambres)";
        $ajoute = $pdo->prepare($query);
        $ajoute->execute([
            'nom' => htmlentities($_POST["txtNom"]),
            'prix' => htmlentities($_POST["txtPrice"]),
            'taille' => htmlentities($_POST["txtTaille"]),
            'ville' => htmlentities($_POST["txtVille"]),
            'bienId' => $_SESSION['user']->id,
            'description' => htmlentities($_POST["txtDescription"]),
            'chambres' => htmlentities($_POST["txtChambres"])
        ]);
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}

/**
 * Cette fonction permet de supprimer un bien
 *
 * @param PDO $pdo
 * @return void
 */
function deleteBien($pdo)
{
    try {
        $query = "delete from biens where bienId=:bienId";
        $ajoute = $pdo->prepare($query);
        $ajoute->execute([
            'bienId' => $_GET['bienId']
        ]);
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}

function addOrDeleteDefaultImageToBien($pdo, $imageId, $bienId)
{
    try {
        $query = "update biens set imageBien=:imageId where bienId = :bienId";
        $ajoute = $pdo->prepare($query);
        $ajoute->execute([
            'imageId' => $imageId,
            'bienId' => $bienId
        ]);
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}


function deleteImage($pdo)
{
    try {
        $query = "delete from images where id=:imageId";
        $ajoute = $pdo->prepare($query);
        $ajoute->execute([
            'imageId' => $_GET['imageIdDelete']
        ]);
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}

/**
 * cette fonction permet de supprimer toutes les options d'un bien
 *
 * @param PDO $pdo
 * @return void
 */
function deleteAllOptionsOfBien($pdo)
{
    try {
        $query = "delete from biens_options where bienId=:bienId";
        $ajoute = $pdo->prepare($query);
        $ajoute->execute([
            'bienId' => $_GET['bienId']
        ]);
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}

function deleteAllImageOfbien($pdo)
{
    try {
        $query = "delete from images where FK_bienId=:bienId";
        $ajoute = $pdo->prepare($query);
        $ajoute->execute([
            'bienId' => $_GET['bienId']
        ]);
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}

/**
 * Fonction permettant de d'ajouter des options à un bien
 *
 * @param PDO $pdo
 * @param id $optionId
 * @param id $bienId
 * @return void
 */
function insertOptionsInBien($pdo, $optionId, $bienId)
{
    try {
        $query = "insert into biens_options (bienId, optionId) VALUES(:bienId, :optionId)";
        $ajoute = $pdo->prepare($query);
        $ajoute->execute([
            'bienId' => $bienId,
            'optionId' => $optionId
        ]);
        return true;
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}
