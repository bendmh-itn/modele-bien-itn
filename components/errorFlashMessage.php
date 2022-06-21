<?php
if (isset($_SESSION['errorMessage'])) : ?>
    <small class="text-danger"><?= $_SESSION['errorMessage'] ?></small>
<?php endif ?>