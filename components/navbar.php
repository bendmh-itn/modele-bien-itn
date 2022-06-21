<?php
/*echo "variable server uri : ";
echo $_SERVER['REQUEST_URI'];
echo " <br>  ";
echo "variable Post : ";
var_dump($_POST);
echo " <br>  ";
echo "variable session : ";
var_dump($_SESSION);
echo "variable env : ";
var_dump($_ENV);
*/
?>

<!-- ENTETE COMMUN à toutes les pages -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/index.php">Immobilier</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <?php if (!isset($_SESSION['user'])) : ?>
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="/index.php">Home</a></li>
                <?php else : ?>
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link active" href="/index.php?page=/templates/mesBiens">Mes Biens</a></li>
                <?php endif ?>
                <?php if (!isset($_SESSION['user'])) : ?>
                    <li class="nav-item"><a class="nav-link active" href="index.php?/templates/inscription.php">S'inscrire</a></li>
                <?php else : ?>
                    <li class="nav-item"><a class="nav-link active" href="/index.php?/templates/editUser.php">Editer profil</a></li>
                <?php endif ?>
                <?php if (isset($_SESSION['user']) && $_SESSION['user']->role === "admin") : ?>
                    <li class="nav-item"><a class="nav-link active" href='/index.php?/admin/index'>Admin</a></li>
                <?php endif ?>
                <?php if (!isset($_SESSION['user'])) : ?>
                    <li class="nav-item"><a class="nav-link active" href='/index.php?/templates/login.php'>Connexion</a></li>
                <?php else : ?>
                    <li class="nav-item"><a class="nav-link active" href='/index.php?/templates/login.php'>Déconnexion</a></li>
                <?php endif ?>
            </ul>
        </div>
    </div>
</nav>