<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="m-auto w50 my-4 p-4 shadow-white radius-10 loginForm">
        <h1 class="titre text-light">Change Password</h1>
        <form action="" method="post" class="">
            <div class="form-line-input my-2 ">
                <label for="oldPassword" class="lab30"></label>
                <input type="password" id="oldPassword" name="oldPassword" value="" class="form-control w-50" placeholder="Old password">
            </div>
            <div class="form-line-input my-2 ">
                <label for="newPassword" class="lab40"></label>
                <input type="password" id="newPassword" name="newPassword" value="" class="form-control w-50" placeholder="New password">
            </div>
            <div class="form-line-input my-2 ">
                <label for="confirmPassword" class="lab40"></label>
                <input type="password" id="confirmPassword" name="confirmPassword" value="" class="form-control w-50" placeholder="Confirm new password">
            </div>
            <div class="div-btn d-flex justify-content-around p-3">
                <a href="accueil" class="btn btn-md btn-primary">Cancel</a>
                <input type="submit" class="btn btn-md btn-primary" value="Submit">
            </div>
            <p id='paragraph'> <?php echo isset($message) ? $message : ''; ?></p>
        </form>
    </div>
</div>