<?php

$uri = $_SERVER['REQUEST_URI'];

if ($uri === '/index.php?/templates/inscription.php') {
    $_ENV["title"] = "Inscription";
} elseif ($uri === '/index.php?/templates/editUser.php') {
    $_ENV["title"] = "Editer";
} elseif (isset($_GET["surfaceMinimum"]) || isset($_GET["surfaceMaximum"]) || isset($_GET["prixMinimum"]) || isset($_GET["prixMaximum"])) {
    $_ENV["title"] = "Biens filtrés";
} elseif ($uri === '/index.php' || $uri === '/') {
    $_ENV["title"] = "Home";
} elseif ($uri === '/index.php?/templates/mesBiens.php') {
    $_ENV["title"] = "Mes biens";
} elseif ($uri === '/index.php?/templates/login.php') {
    $_ENV["title"] = "Connexion";
} elseif ($uri === '/index.php?/templates/createBien.php') {
    $_ENV["title"] = "Créer un bien";
} elseif (isset($_GET['bienId']) && isset($_GET['action']) && $_GET['action'] == "show") {
    $_ENV["title"] = "Voir le bien";
} elseif (isset($_GET['bienId'])) {
    $_ENV["title"] = "Editer un bien";
} elseif ($uri == '/index.php?/admin/index') {
    $_ENV["title"] = "Partie admin";
} else {
    $_ENV["title"] = "404 Error";
}
