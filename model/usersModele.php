<?php

/**
 * Fonction permettant à l'utilisateur de se connecter
 *
 * @param PDO $pdo
 * @return void
 */
function EstUserPresent(PDO $pdo)
{
   try {
      $query = "select * from utilisateurs where loginUser=:login AND passWordUser=:password";
      $profil = $pdo->prepare($query);
      $profil->execute([
         'login' => htmlentities($_POST["txtLogin"]),
         'password' => htmlentities($_POST["txtMp"])
      ]);
      $user = $profil->fetch();
      if ($user) {
         $_SESSION['user'] = $user;
      }
   } catch (PDOException $e) {
      $message = $e->getMessage();
      die($message);
   }
}

/**
 * fonction permettant de récupérer tous les utilisateurs du site
 *
 * @param PDO $pdo
 * @return $users
 */
function getUsers($pdo)
{
   try {
      $query = "select * from utilisateurs";
      $ajoute = $pdo->prepare($query);
      $ajoute->execute();
      $users = $ajoute->fetchAll();
      return $users;
   } catch (PDOException $e) {
      $message = $e->getMessage();
      die($message);
   }
}

/**
 * fonction permettant de créer un utilisateur dans la BDD
 *
 * @param PDO $pdo
 * @return void
 */
function createUser($pdo)
{
   try {
      $query = "insert into utilisateurs (nomUser, prenomUser, loginUser, passWordUser) values (:nom, :prenom, :login, :password)";
      $ajoute = $pdo->prepare($query);
      $ajoute->execute([
         'nom' => htmlentities($_POST["txtNom"]),
         'prenom' => htmlentities($_POST["txtPrenom"]),
         'login' => htmlentities($_POST["txtLogin"]),
         'password' => htmlentities($_POST["txtMp"])
      ]);
   } catch (PDOException $e) {
      $message = $e->getMessage();
      die($message);
   }
}

/**
 * Cette fonction permet à l'utilsiateur de modifier ses données
 *
 * @param PDO $pdo
 * @return void
 */
function editerUser($pdo)
{
   try {
      $query = "update utilisateurs set nomUser = :nom, prenomUser = :prenom, loginUser = :login, passWordUser= :password where id = :userId";
      $ajoute = $pdo->prepare($query);
      $ajoute->execute([
         'nom' => htmlentities($_POST["txtNom"]),
         'prenom' => htmlentities($_POST["txtPrenom"]),
         'login' => htmlentities($_POST["txtLogin"]),
         'password' => htmlentities($_POST["txtMp"]),
         'userId' => $_SESSION['user']->id
      ]);
      $query = "select * from utilisateurs where id=:userId";
      $ajoute = $pdo->prepare($query);
      $ajoute->execute([
         'userId' => $_SESSION['user']->id
      ]);
      $_SESSION['user'] = $ajoute->fetch();
   } catch (PDOException $e) {
      $message = $e->getMessage();
      die($message);
   }
}

function deleteUser($pdo)
{
   try {
      $query = "delete from utilisateurs where id=:userId";
      $ajoute = $pdo->prepare($query);
      $ajoute->execute([
         'userId' => $_SESSION['user']->id
      ]);
   } catch (PDOException $e) {
      $message = $e->getMessage();
      die($message);
   }
}
