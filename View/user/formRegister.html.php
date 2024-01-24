<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="m-auto w50 my-4 p-4  shadow-white radius-10 loginForm">
        <h1 class="titre text-light">Inscrivez-vous</h1>
        <form action="" method="post" class="">
            <div class=" my-4">
                <label for="username" class="lab30">IDENTIFIANT</label>
                <input type="text" id="username" name="username" value="" class="form-control w-50" autocomplete="off">
            </div>
            <div class=" my-4">
                <label for="email" class="lab30">EMAIL</label>
                <input type="email" id="email" name="email" value="" class="form-control w-50" autocomplete="off">
            </div>
            <div class=" my-4">
                <label for="password" class="lab30">PASSWORD</label>
                <input type="password" id="password" name="password" value="" class="form-control w-50" autocomplete="off">
            </div>
            <div class=" my-4">
                <label for="confirmPassword" class="lab30">CONFIRM PASSWORD</label>
                <input type="password" id="confirmPassword" name="confirmPassword" value="" class="form-control w-50" autocomplete="off">
            </div>
            <div class=" my-4" hidden>
                <label for="roles" class="lab30">ROLE</label>
                <input type="text" id="roles" name="roles" value='["ROLE_USER"]' class="form-control w-50" autocomplete="off">
            </div>
            <div class="div-btn d-flex justify-content-around p-3">
                <a href="accueil" class="btn btn-md btn-primary">Quitter</a>
                <input type="submit" class="btn btn-md btn-primary" value="valider">
            </div>
            
            <p id='paragraph'> <?php echo isset($message) ? $message : ''; ?></p>
        </form>
    </div>
</div>