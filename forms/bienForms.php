<form method="post" action="" enctype="multipart/form-data">
    <h2><?= $message ?></h2>
    <div class="mb-3">
        <label for="nom" class="form-label">Nom du bien</label>
        <input type="text" class="form-control" name="txtNom" <?php if (isset($bien)) : ?>value="<?= $bien->nom ?>" <?php endif ?> />
    </div>
    <div class="mb-3">
        <label for="taille" class="form-label">Taille</label>
        <input type="number" class="form-control" name="txtTaille" <?php if (isset($bien)) : ?>value="<?= $bien->taille ?>" <?php endif ?> />
        <?php if (isset($errorTxtTaille)) : ?><small class="text-danger"><?= $errorTxtTaille ?></small><?php endif ?>
    </div>
    <div class="mb-3">
        <label for="prix" class="form-label">Prix</label>
        <input type="number" class="form-control" name="txtPrice" <?php if (isset($bien)) : ?>value="<?= $bien->prix ?>" <?php endif ?> />
        <?php if (isset($errorTxtPrice)) : ?><small class="text-danger"><?= $errorTxtPrice ?></small><?php endif ?>
    </div>
    <div class="mb-3">
        <label for="ville" class="form-label">Ville</label>
        <input type="text" class="form-control" name="txtVille" <?php if (isset($bien)) : ?>value="<?= $bien->ville ?>" <?php endif ?> />
    </div>
    <div class="mb-3">
        <label for="ville" class="form-label">Nombre de chambres</label>
        <input type="number" class="form-control" name="txtChambres" <?php if (isset($bien)) : ?>value="<?= $bien->chambres ?>" <?php endif ?> />
        <?php if (isset($errorTxtChambres)) : ?><small class="text-danger"><?= $errorTxtChambres ?></small><?php endif ?>
    </div>
    <div class="mb-3">
        <label for="ville" class="form-label">Description du bien</label>
        <textarea rows="5" class="form-control" name="txtDescription"><?php if (isset($bien)) : ?><?= $bien->description ?><?php endif ?></textarea>
    </div>
    <div class="mb-3">
        <label for="ville" class="form-label">Choisir les options</label>
        <div><?php require_once('components/select.php');  ?></div>
    </div>
    <div class="mb-3">
        <label for="ville" class="form-label">Mettre une image pour la page de garde</label>
        <input type="file" class="form-control" name="imageDefault">
    </div>
    <div class="mb-3">
        <button class="btn btn-primary" name="btnEnvoi"><?= $button ?></button>
    </div>
</form>