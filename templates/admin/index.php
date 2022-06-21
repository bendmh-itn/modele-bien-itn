<?php require_once "components/jumbotron.php"; ?>
<div class="container">
    <div class="mb-4">
        <a href="/index.php?/admin/delete/files"><button class="btn btn-danger">Supprimer les images </button></a>
        <a href="/index.php?/admin/add/option"><button class="btn btn-primary">Ajouter une option</button></a>
    </div>
    <?php if (isset($option)) : ?>
        <?php require_once "forms/optionForms.php"; ?>
    <?php endif ?>
</div>