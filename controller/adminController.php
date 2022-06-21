<?php

$uri = $_SERVER['REQUEST_URI'];

if ($uri == '/index.php?/admin/index') {
    if ($_SESSION['user']->role !== "admin") {
        header('Location:/index.php/pageNotFound.php');
    } else {
        $jumbotron = "Partie administration";
        require_once "templates/admin/index.php";
    }
} elseif ($uri == '/index.php?/admin/add/option') {
    if ($_SESSION['user']->role !== "admin") {
        header('Location:/index.php/pageNotFound.php');
    } else {

        if (isset($_POST["btnEnvoi"])) {
            addOption($pdo);
        }
        $jumbotron = "Partie administration";
        $option = true;
        $titre = "Ajouter une option";
        $button = "Ajouter";
        require_once "templates/admin/index.php";
    }
} elseif ($uri == '/index.php?/admin/delete/files') {
    $images = selectAllImages($pdo);
    $files = array_diff(scandir('images/DB'), array('.', '..'));
    foreach ($files as $file) {
        $inDatabase = false;
        $i = 0;
        while (!$inDatabase && $i < count($images)) {
            if ($file == $images[$i]->name) {
                $inDatabase = true;
            }
            $i++;
        }
        if (!$inDatabase) {
            unlink('images/DB/' . $file);
        }
    }
}
