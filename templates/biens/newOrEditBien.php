<?php require_once "components/jumbotron.php"; ?>
<div class="container">
    <?php require_once "components/alertFlashMessage.php"; ?>

    <div class="row justify-content-center">
        <div class="col-sm-6">
            <?php require_once "forms/bienForms.php"; ?>
        </div>
        <div class="col-sm-6">
            <?php if ($uri !== '/index.php?/templates/createBien.php') : ?>
                <?php require_once "forms/addImageForms.php"; ?>
                <h2>Les images choisies pour le bien</h2>
                <?php require_once "components/caroussel.php"; ?>
            <?php else : ?>
                <h2>Les images d'intérieurs s'ajoutent par la suite</h2>
            <?php endif ?>
        </div>

    </div>
</div>