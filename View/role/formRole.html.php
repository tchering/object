<div class="m-auto w80 form">
    <h1 class="titre text-light">SAISIE USER</h1>
    <form action="user&action=save" method="POST" class="form-container" enctype="multipart/form-data">
        <div class="my-2 hidden">
            <label for="" class="lab30"></label>
            <input type="text" class="from-control w50" id="id" name="id" value="<?= $id ?>" <?= $disabled ?>>
        </div>
        <div class="line-input">
            <label for="rang" class="lab30 obligatoire">RANG</label>
            <input type="text" class="from-control w50" id="rang" name="rang" value="<?= $rang ?>" <?= $disabled ?>>
        </div>

        <div class="line-input my-2">
            <label for="libelle" class="lab30">LIBELLE</label>
            <input type="text" class="from-control w50" id="libelle" name="libelle" value="<?= $libelle ?>" <?= $disabled ?>>
        </div>
        <div class="div_btn">
            <a href="javascript:history.back()" class="btn btn-sm btn-secondary">Retourner</a>
            <input type="reset" class="btn btn-md btn-danger" value="Annuler" <?= $disabled ?>>
            <input type="submit" class="btn btn-md btn-primary" value="Valider" <?= $disabled ?>>
        </div>
    </form>
</div>
