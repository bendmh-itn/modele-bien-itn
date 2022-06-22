<?php
session_start();

(new DotEnv(__DIR__ . '/.env'))->load();

require_once 'config/connect.php';
require_once 'model/usersModele.php';
require_once 'model/biensModele.php';
require_once 'model/imagesModele.php';
require_once 'model/optionsModele.php';
require_once 'config/gestionVariables.php';
require_once 'config/loadVariable.php';

var_dump(getenv('APP_ENV'));

?>

<!DOCTYPE html>

<html lang="fr">

<head>
    <meta charset="utf-8" />
    <link href="css/base.css" rel="Stylesheet" type="text/css" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title><?= $_ENV["title"] ?></title>
</head>

<body>
    <header>
        <?php require_once "components/navbar.php"; ?>
    </header>

    <main>
        <!-- CORPS VARIE de page en page -->
        <?php require_once "controller/userController.php"; ?>
        <?php require_once "controller/adminController.php"; ?>
        <?php require_once "controller/biensController.php"; ?>
    </main>
    <footer><?php require_once "components/footer.php"; ?></footer>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('.selectStyle').select2({
                placeholder: 'Choisis une ou plusieurs options'
            });
        });
    </script>
</body>


</html>