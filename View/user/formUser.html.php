<div class="m-auto w80 form">
    <h1 class="titre text-light">SAISIE USER</h1>
    <form action="user&action=save" method="POST" class="form-container" enctype="multipart/form-data">
        <div class="my-2 hidden">
            <label for="" class="lab30"></label>
            <input type="text" class="from-control w50" id="id" name="id" value="<?= $id ?>" <?= $disabled ?>>
        </div>
        <div class="line-input">
            <label for="username" class="lab30 obligatoire">USERNAME</label>
            <input type="text" class="from-control w50" id="username" name="username" value="<?= $username ?>" <?= $disabled ?>>
        </div>
        <!--todo New input added here for photo -->
       
        <div class="line-input">
            <label for="photo" class="lab30 obligatoire lab30">PHOTO</label>
            <img id="image_view" src="Public/upload/<?= $photo ?>" width="20%" class=" img-fluid">
            <input class="ml30" type="file" class="from-control w50" id="photo" name="photo" value="" onChange="previewImage(event,'image_view')" <?= $disabled ?>>
        </div>

        <div class="line-input my-2">
            <label for="email" class="lab30">EMAIL</label>
            <input type="text" class="from-control w50" id="email" name="email" value="<?= $email ?>" <?= $disabled ?>>
        </div>
        <div class="line-input my-2">
            <label for="password" class="lab30 obligatoire">PASSWORD</label>
            <input type="password" class="from-control w50" id="password" name="password" value="<?= $password ?>" <?= $disabled ?>required>
        </div>
        <!-- this is multiple selection and also dropdown -->
        <!-- <div class="line-input my-2">
            <label for="roles" class="lab30">ROLES</label>
            <select class="w60 form-control" id="roles" name="roles[]" multiple>
                <?php foreach ($roles as $role) : ?>
                    <option value="<?= $role['libelle'] ?>" <?= $role['selected'] ?>><?= $role['libelle'] ?></option>
                <?php endforeach; ?>
            </select>
        </div> -->
        <?php if (MyFct::isGranted('ROLE_ADMIN')) : ?>
            <div class="line-input my-2">
                <label for="" class="lab30">ROLES</label>
                <ul class="ml30 p-0">
                    <?php foreach ($roles as $role) : ?>
                        <li>
                            <input type="checkbox" name="roles[]" value="<?= $role['libelle'] ?>" <?= $role['checked'] ?>>
                            <?= $role['libelle'] ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        <div class="div_btn">
            <a href="javascript:history.back()" class="btn btn-sm btn-secondary">Retourner</a>
            <input type="reset" class="btn btn-md btn-danger" value="Annuler" <?= $disabled ?>>
            <input type="submit" class="btn btn-md btn-primary" value="Valider" <?= $disabled ?>>
        </div>
    </form>
</div>