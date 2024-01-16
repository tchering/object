<div class="m-auto w80 form">
    <h1 class="titre text-light">SAISIE ARTICLE</h1>
    <form action="client&action=save" method="POST" class="form-container">
            <div class="my-2 hidden">
                <label for="id" class="lab30"></label>
            <input type="text" class="from-control w50" id="id" name="id" value="<?= $id ?>" <?= $disabled ?>>
        </div>
        <div class="line-input">
            <label for="numArticle" class="lab30">Code</label>
            <input type="text" class="from-control w50" id="numArticle" name="numArticle" value="<?= $numArticle ?>" <?= $disabled ?>>
        </div>
        <div class="line-input my-2">
            <label for="designation" class="lab30">DESIGNATION</label>
            <input type="text" class="from-control w50" id="designation" name="designation" value="<?= $designation ?>" <?= $disabled ?>>
        </div>
        <div class="line-input my-2">
            <label for="prixUnitaire" class="lab30">PU</label>
            <input type="text" class="from-control w50" id="prixUnitaire" name="prixUnitaire" value="<?= $prixUnitaire?>" <?= $disabled ?>>
        </div>
        <div class="div_btn">
            <a href="javascript:history.back()" class="btn btn-sm btn-secondary">Retourner</a>
            <input type="reset" class="btn btn-md btn-danger" value="Annuler" <?= $disabled ?>>
            <input type="submit" class="btn btn-md btn-primary" value="Valider" <?= $disabled ?>>
        </div>
    </form>
</div>