<?php require_once "components/jumbotron.php"; ?>
<div class="container">
    <?php require_once "components/alertFlashMessage.php"; ?>

    <?php if (isset($_SESSION['user'])) : ?>
        <a href="/index.php?/templates/createBien.php"><button class="btn btn-primary mb-3">Créer un bien</button></a>
    <?php endif ?>

    <?php if ($uri !== '/index.php?/templates/mesBiens.php') : ?>
        <h2>Filtrer les biens</h2>
        <?php require_once "forms/filterForms.php"; ?>
    <?php endif ?>

    <div class="row justify-content-center">
        <?php foreach ($biens as $bien) : ?>
            <div class="col-sm-4">
                <div class="card myCard mt-3">
                    <h5 class="card-header d-flex justify-content-center align-items-center"><?= $bien->nom ?></h5>
                    <div class="card-body text-center">
                        <?php if (!isset($bien->FK_bienId)) : ?>
                            <a href="/index.php?action=show&bienId=<?= $bien->bienId ?>">
                                <div class="blocImage d-flex justify-content-center align-items-center"><img class=" imageHorizontale" src="images/maison.jfif" alt="photo maison" /></div>
                            </a>
                        <?php else : ?>
                            <a href="/index.php?action=show&bienId=<?= $bien->bienId ?>">
                                <div class="blocImage d-flex justify-content-center align-items-center"><img class="<?php if (getimagesize($bien->image)[0] > getimagesize($bien->image)[1]) : ?>imageHorizontale<?php else : ?>imageVerticale<?php endif ?>" src="<?= $bien->image; ?>" /></div>
                            </a>
                        <?php endif ?>
                        <p class="card-text mt-3"><?= $bien->taille ?>m² - <?= $bien->ville ?></p>
                        <h5 class="card-title"><?= number_format($bien->prix, 0, ',', ' '); ?>€</h5>
                        <?php if ($uri == '/index.php?/templates/mesBiens') : ?>
                            <a href="/index.php?action=modify&bienId=<?= $bien->bienId ?>"><button class="btn btn-secondary mb-2">Modifier le bien</button></a>
                            <a href="/index.php?action=delete&bienId=<?= $bien->bienId ?>"><button class="btn btn-danger mb-2">Supprimer le bien</button></a>
                        <?php else : ?>
                            <a href="/index.php?action=show&bienId=<?= $bien->bienId ?>"><button class="btn btn-primary mb-2">Voir le bien</button></a>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>