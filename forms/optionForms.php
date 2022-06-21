<form method="post" action="">
    <h2><?= $titre ?></h2>
    <div class="mb-3">
        <label for="option" class="form-label">Nom de l'option</label>
        <input type="text" class="form-control" name="txtOption" <?php if (isset($bien)) : ?>value="<?= $bien->nom ?>" <?php endif ?> />
    </div>
    <div class="mb-3">
        <button class="btn btn-primary" name="btnEnvoi"><?= $button ?></button>
    </div>
</form>