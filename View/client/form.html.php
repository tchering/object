<div class="m-auto w80">
    <h1 class="titre text-light">SAISIE CLIENT</h1>
    <form action="" method="post" class="form-container">
            <div class="line-input">
                <label for="" class="lab30"></label>
            <input type="text" class="from-control w50" id="id" name="id" value="<?= $id ?>" <?= $disabled ?>>
        </div>
        <div class="line-input">
            <label for="numClient" class="lab30"></label>
            <input type="text" class="from-control w50" id="numClient" name="numClient" value="<?= $numClient ?>" <?= $disabled ?>>
        </div>
        <div class="line-input">
            <label for="nomClient" class="lab30"></label>
            <input type="text" class="from-control w50" id="nomClient" name="nomClient" value="<?= $nomClient ?>" <?= $disabled ?>>
        </div>
        <div class="line-input">
            <label for="adresseClient" class="lab30"></label>
            <input type="text" class="from-control w50" id="adresseClient" name="adresseClient" value="<?= $adresseClient ?>" <?= $disabled ?>>
        </div>
        <div class="div_btn">
            <a href="javascript:history.back()" class="btn btn-sm btn-secondary">Retourner</a>
            <input type="reset" class="btn btn-md btn-danger" value="Annuler" <?= $disabled ?>>
            <input type="submit" class="btn btn-md btn-primary" value="Valider" <?= $disabled ?>>
        </div>
    </form>
</div>