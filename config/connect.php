<?php


try {
    // chaine de connection : informations sur la base de données
    $strConnection = 'mysql:host=oliadkuxrl9xdugh.chr7pe7iynqr.eu-west-1.rds.amazonaws.com;dbname=vi64zrmqvjdyc1l8';
    // nouvel objet pdo pour appliquer la connection  (chaine, username et password)
    $pdo = new PDO($strConnection, 'id1nl7ml2e90dl2y', 'b2ipf4dyztakjtd1', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
    ]);
} catch (PDOException $e) {
    // récupération du message de l'exception
    $msg = 'ERREUR PDO dans ' .  $e->getMessage();
    // envoi du message dans la sortie, ici ce sera la page de l'utilisateur
    die($msg);
}
