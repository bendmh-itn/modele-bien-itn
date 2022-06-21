<?php

$uri = $_SERVER['REQUEST_URI'];

if ($uri === '/index.php?/templates/inscription.php') {
    if (isset($_POST["btnEnvoi"])) {
        if ($_POST["txtNom"] && $_POST["txtPrenom"] && $_POST["txtLogin"] && $_POST["txtMp"]) {
            createUser($pdo);
            $_SESSION['flashMessage'] = "Création du compte réussi. Connecte toi maintenant";
            $_SESSION['flashColor'] = "success";
            header('Location:/index.php?/templates/login.php');
        } else {
            $_SESSION['flashMessage'] = "Un champ ou plusieurs champs ne sont pas complétés";
            $_SESSION['flashColor'] = "danger";
        }
    }
    $jumbotron = "Inscription";
    $message = "Créer votre compte";
    $button = "Créer";
    require_once "templates/user/newOrEditUser.php";
} elseif ($uri === '/index.php?/templates/editUser.php') {
    if (isset($_POST["btnEnvoi"])) {
        if ($_POST["txtNom"] && $_POST["txtPrenom"] && $_POST["txtLogin"] && $_POST["txtMp"]) {
            editerUser($pdo);
            $_SESSION['flashMessage'] = "Votre profil a été modifié";
            $_SESSION['flashColor'] = "success";
        } else {
            $_SESSION['flashMessage'] = "Un champ ou plusieurs champs ne sont pas complétés";
            $_SESSION['flashColor'] = "danger";
        }
    }
    $jumbotron = "Modifier votre profil";
    $message = "Vos données";
    $button = "Modifier";
    require_once "templates/user/newOrEditUser.php";
} elseif ($uri === '/index.php?/templates/deleteUser.php') {
    deleteUser($pdo);
    session_destroy();
    $_SESSION['flashMessage'] = "Votre profil a été supprimé";
    $_SESSION['flashColor'] = "success";
    require_once "templates/user/login.php";
} elseif ($uri === '/index.php?/templates/login.php') {

    if (isset($_SESSION['user'])) {
        session_destroy();
        $_SESSION['flashMessage'] = "Votre compte est supprimé. Au revoir !";
        $_SESSION['flashColor'] = "success";
        header('Location:/index.php');
    }

    if (isset($_POST["btnEnvoi"])) {
        if ($_POST['txtLogin']  && $_POST['txtMp']) {
            EstUserPresent($pdo);
            if (!isset($_SESSION['user'])) {
                $_SESSION['flashMessage'] = "Login ou mot de passe incorrect";
                $_SESSION['flashColor'] = "danger";
            } else {
                header('Location:/index.php');
            }
        } else {
            $_SESSION['flashMessage'] = "Encodez un login et un mot de passe !";
            $_SESSION['flashColor'] = "danger";
        }
    }
    $jumbotron = "Connexion";
    require_once "templates/user/login.php";
}
