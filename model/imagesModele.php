<?php

/**
 * Fonction permettant d'ajouter une image sur un bien
 *
 * @param PDO $pdo
 * @param File $image
 * @return boolean
 */
function addImageToBien($pdo, $imageName, $image)
{
    try {
        $query = "insert into images (name,image, FK_bienId) VALUES(:imageName,:image, :bienId)";
        $ajoute = $pdo->prepare($query);
        $ajoute->execute([
            'imageName' => $imageName,
            'image' => $image,
            'bienId' => $_GET['bienId']
        ]);
        return true;
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}

function selectAllImages($pdo)
{
    try {
        $query = "select * from images";
        $ajoute = $pdo->prepare($query);
        $ajoute->execute();
        $images = $ajoute->fetchAll();
        return $images;
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}


/**
 * Fonction permettant d'obtenir toutes les images d'un bien
 *
 * @param PDO $pdo
 * @return void
 */
function selectImagesOfBien($pdo)
{
    try {
        $query = "select * from images where FK_bienId=:bienId";
        $ajoute = $pdo->prepare($query);
        $ajoute->execute([
            'bienId' => $_GET['bienId']
        ]);
        $images = $ajoute->fetchAll();
        return $images;
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}
