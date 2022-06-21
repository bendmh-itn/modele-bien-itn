<div id="carouselExampleControls" class="carousel slide mt-3" data-bs-ride="carousel">
    <div class="carousel-inner">
        <?php if ($bien->imageBien === null) : $imageDefault = true; ?>
            <div class="blocCaroussel carousel-item active">
                <img class="mx-auto d-block imageVerticale" src="images/maison.jfif" alt="photo par défaut">
                <div class="d-flex justify-content-evenly align-items-center">
                    <?php if ($_GET["action"] == "modify") : ?>
                        <small class="mt-2">Image par défaut (Impossible à supprimer)</small>
                    <?php endif ?>
                </div>
            </div>
        <?php endif ?>
        <?php $i = 0;
        foreach ($images as $image) : ?>
            <div class="blocCaroussel text-center carousel-item <?php if ($i == 0 && !isset($imageDefault)) : ?>active<?php endif ?>">
                <img class="mx-auto d-block imageVerticale" src="<?= $image->image ?>" alt="Slide">
                <?php if ($_GET["action"] == "modify") : ?>
                    <?php if ($bien->imageBien === $image->id) : ?>
                        <small class="mt-2">Image de présentation</small>
                        <a href="/index.php?imageDefaultIdDelete=<?= $bien->bienId ?>"><button class="btn btn-danger mt-3 ml-3">Supprimer</button></a>
                    <?php else : ?>
                        <a href="/index.php?bienId=<?= $bien->bienId ?>&imageIdDelete=<?= $image->id ?>"><button class="btn btn-danger mt-3">Supprimer</button></a>
                    <?php endif ?>
                <?php endif ?>
            </div>
        <?php $i++;
        endforeach ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>