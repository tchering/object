public function changepassword($data)
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $um = new UserManager();
        extract($data);
        $userId = $_SESSION['userId']; // Store only user's ID in the session
        $message = "";

        // Retrieve the current password from the database
        $currentPassword = $um->getPassword($userId); // Get password using user's ID

        // Hash the old password input to compare with the current password
        $oldPassword = sha1($oldPassword);

        // Comparing old password with current user password
        if ($oldPassword !== $currentPassword) {
            $message = "<p class='red text-center'>Votre password ancien est incorrect</p>";
        } elseif ($newPassword === $oldPassword) {
            $message = "<p>Your new password cannot be the same as the old password</p>";
        }
        // Compare if new password and confirm password are the same
        elseif ($confirmPassword !== $newPassword) {
            $message = "<p class='red text-center'>Confirmation password does not match with the new password</p>";
        } else {
            // Hash the new password before storing it in the database
            $newPassword = sha1($newPassword);

            $connexion = $um->connexion();
            $sql = "UPDATE user SET password = ? WHERE id = ?"; // Update using user's ID
            $request = $connexion->prepare($sql);
            $success = $request->execute([$newPassword, $userId]);
            if ($success) {
                $message = "<p class='text-success'>Votre mot de passe a été modifié avec succès.</p>";
            } else {
                $message = "<p class='text-danger'>Failed to change password.</p>";
            }
        }

        $variables = [
            'message' => $message,
        ];
        $file = "View/user/formChangePassword.html.php";
        $this->generatePage($file, $variables);
    }
}