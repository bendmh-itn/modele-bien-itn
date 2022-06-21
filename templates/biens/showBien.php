<?php require_once "components/jumbotron.php"; ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-8">
            <?php require_once "components/caroussel.php"; ?>
        </div>
        <div class="col-sm-4">
            <h2>Habitation à vendre</h2>
            <div class="text-center">
                <h3><?= $bien->nom ?></h3>
                <h4><?= $bien->chambres ?> chambres - <?= $bien->taille ?>m²</h4>
                <h1 class="mt-5"><?= number_format($bien->prix, 0, ',', ' '); ?>€</h1>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <h4>Description</h4>
        <p><?= $bien->description ?></p>
        <h4>Caractéristiques du bien</h4>
        <table class="table table-striped">
            <tbody>
                <tr>
                    <th scope="row">Surface habitable</th>
                    <td><?= $bien->taille ?>m²</td>
                </tr>
                <tr>
                    <th scope="row">Nombre de chambres</th>
                    <td><?= $bien->chambres ?></td>
                </tr>
                <tr>
                    <th scope="row">Options</th>
                    <td><?php foreach ($options as $option) : ?><?= $option->optionNom ?>, <?php endforeach ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>