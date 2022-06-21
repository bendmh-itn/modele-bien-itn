<form method="post" action="">
    <h2><?= $message ?></h2>
    <div class="mb-3">
        <label for="Nom" class="form-label">Nom</label>
        <input type="text" class="form-control" id="Nom" name="txtNom" <?php if (isset($_SESSION['user'])) : ?>value="<?= $_SESSION['user']->nomUser ?>" <?php endif ?>>
    </div>
    <div class="mb-3">
        <label for="Prenom" class="form-label">Mot de passe</label>
        <input type="text" class="form-control" id="Prenom" name="txtPrenom" <?php if (isset($_SESSION['user'])) : ?>value="<?= $_SESSION['user']->prenomUser ?>" <?php endif ?>>
    </div>
    <div class="mb-3">
        <label for="Login" class="form-label">Login</label>
        <input type="text" class="form-control" id="Login" name="txtLogin" <?php if (isset($_SESSION['user'])) : ?>value="<?= $_SESSION['user']->loginUser ?>" <?php endif ?>>
    </div>
    <div class="mb-3">
        <label for="Password" class="form-label">Mot de passe</label>
        <input type="password" class="form-control" id="Password" name="txtMp" <?php if (isset($_SESSION['user'])) : ?>value="<?= $_SESSION['user']->passWordUser ?>" <?php endif ?>>
    </div>
    <div>
        <button name="btnEnvoi" class="btn btn-primary"><?= $button ?></button>
    </div>
</form>