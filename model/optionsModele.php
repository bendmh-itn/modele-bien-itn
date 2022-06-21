<?php

/**
 * Fonction permettant d'obtenir toutes les options d'un bien
 *
 * @param PDO $pdo
 * @return void
 */
function selectOptionsOfBien($pdo)
{
    try {
        $query = "select * from options where optionId in (select optionId from biens_options where bienId=:bienId)";
        $ajoute = $pdo->prepare($query);
        $ajoute->execute([
            'bienId' => $_GET['bienId']
        ]);
        $options = $ajoute->fetchAll();
        return $options;
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}

/**
 * Selectionne toutes les options de la DB
 *
 * @param PDO $pdo
 * @return void
 */
function selectAllOptions($pdo)
{
    try {
        $query = "select * from options";
        $ajoute = $pdo->prepare($query);
        $ajoute->execute();
        $allOptions = $ajoute->fetchAll();
        return $allOptions;
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}


function addOption($pdo)
{
    try {
        $query = "insert into options (optionNom) values (:optionNom)";
        $ajoute = $pdo->prepare($query);
        $ajoute->execute([
            'optionNom' => htmlentities($_POST["txtOption"]),
        ]);
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}
