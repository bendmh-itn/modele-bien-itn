<form method="get" action="index.php">
    <div class="row justify-content-center">
        <div class="mb-3 col-sm-3 col-6">
            <input type="number" class="form-control" name="surfaceMinimum" placeholder="Surface minimum" <?php if (isset($_GET["surfaceMinimum"]) && $_GET["surfaceMinimum"]) : ?>value="<?= $_GET["surfaceMinimum"] ?>" <?php endif ?> />
        </div>
        <div class="mb-3 col-sm-3 col-6">
            <input type="number" class="form-control" name="surfaceMaximum" placeholder="Surface maximum" <?php if (isset($_GET["surfaceMaximum"]) && $_GET["surfaceMaximum"]) : ?>value="<?= $_GET["surfaceMaximum"] ?>" <?php endif ?> />
        </div>
        <div class="mb-3 col-sm-3 col-6">
            <input type="number" class="form-control" name="prixMinimum" placeholder="Prix minimum" <?php if (isset($_GET["prixMinimum"]) && $_GET["prixMinimum"]) : ?>value="<?= $_GET["prixMinimum"] ?>" <?php endif ?> />
        </div>
        <div class="mb-3 col-sm-3 col-6">
            <input type="number" class="form-control" name="prixMaximum" placeholder="Prix maximum" <?php if (isset($_GET["prixMaximum"]) && $_GET["prixMaximum"]) : ?>value="<?= $_GET["prixMaximum"] ?>" <?php endif ?> />
        </div>
        <div class="mb-3">
            <button class="btn btn-success" type="submit">Rechercher</button>
        </div>
    </div>
</form>