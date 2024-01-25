<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="m-auto w50 my-4 p-4  shadow-white radius-10 loginForm">
        <h1 class="titre text-light">LOGIN</h1>
        <form action="" method="post" class="">
            <div class=" my-4">
                <label for="username" class="lab30">IDENTIFIANT</label>
                <input type="text" id="username" name="username" value="" class="form-control w-50" autocomplete="off" placeholder="username or email">
            </div>
            <div class="form-line-input my-2 ">
                <label for="password" class="lab30">MOT DE PASSE</label>
                <input type="password" id="password" name="password" value="" class="form-control w-50" placeholder="password">
            </div>
            <div class="div-btn d-flex justify-content-around p-3">
                <a href="accueil" class="btn btn-md btn-primary">Quitter</a>
                <input type="submit" class="btn btn-md btn-primary" value="valider">
            </div>
            <p id='paragraph'> <?php echo isset($message) ? $message : ''; ?></p>
        </form>
    </div>
</div>