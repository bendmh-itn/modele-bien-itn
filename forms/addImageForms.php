<form method="post" action="" enctype="multipart/form-data">
    <h2>Ajouter des images</h2>
    <div class="mb-3">
        <label for="ville" class="form-label">Mettre des images pour défilement</label>
        <input type="file" class="form-control" name="image[]" multiple>
    </div>
    <div class="mb-3">
        <button class="btn btn-primary" name="btnEnvoiImage">Ajouter</button>
    </div>
</form>