<?php require_once "components/jumbotron.php"; ?>
<div class="container">
    <?php require_once "components/alertFlashMessage.php"; ?>

    <?php require_once "forms/inscriptionForms.php"; ?>

    <?php if (isset($_SESSION['user'])) : ?>
        <a href="/index.php?/templates/deleteUser.php"><button class="btn btn-danger mt-3">Supprimer le compte</button></a>
    <?php endif ?>
</div>