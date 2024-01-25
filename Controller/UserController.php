<?php
class UserController extends MyFct
{
    public function __construct()
    {
        $action = "list";
        extract($_GET);
        switch ($action) {
            case 'search':
                $this->searchUser($mot);
                break;
            case "list":
                if($this->notgranted('ROLE_ADMIN')) $this->throwMessage('You dont have right to use this action');
                $this->listUser();
                break;
            case "show":
                if($this->notgranted('ROLE_ADMIN')) $this->throwMessage('You dont have right to use this action');
                $this->showUser($id);
                break;
            case "insert":
                if($this->notgranted('ROLE_ADMIN')) $this->throwMessage('You dont have right to use this action');
                $this->insertUser();
                break;
            case "update":
                if($this->notgranted('ROLE_ADMIN')) $this->throwMessage('You dont have right to use this action');
                //! A lets say user want to modify id 1. now 1 is stored in $id and updateUser is called
                $this->updateUser($id);
                break;
            case 'save':
               if($this->notgranted('ROLE_ADMIN')) $this->throwMessage('You dont have right to use this action');
                $this->saveUser($_POST);
                break;
            case "delete":
                if($this->notgranted('ROLE_ADMIN')) $this->throwMessage('You dont have right to use this action');
                // Assuming there's a deleteUser method
                $this->deleteUser($id);
                break;
            case 'login':
                if ($_POST) { //! if not empty the valider what is inside $post
                    // $this->printr($_POST);die;
                    $this->valider($_POST);
                }
                $this->seConnecter();
                break;
            case 'logout':
                $this->seDeconnecter();
                break;
            case 'changePassword':
                if ($_POST) {
                    $this->changepassword($_POST);
                }
                $this->changeUserPass();
                break;
            case 'register':
                if ($_POST) {
                    $this->userRegister($_POST);
                }
                $this->userRegisterForm();
                break;
        } // This is the missing closing brace
    }

    // My functions
    function userRegister($data)
    {
        $um = new UserManager();
        extract($data);
        // $this->printr($data);die;
        $um->register($data);
        $manager = new Manager();
        $message = $manager->registerUser('user', $data);
        $file = "View/user/formRegister.html.php";
        $variables = [
            'message' => $message,
        ];
        $this->generatePage($file, $variables);
    }
    //todo -----------------userRegisterFrom------------------
    function userRegisterForm()
    {
        $file = "View/user/formRegister.html.php";
        $this->generatePage($file);
    }

    //todo -----------------changePassword()------------------
    public function changepassword($data)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $um = new UserManager();
            extract($data);
            // $this->printr($data);
            $username = $_SESSION['username'];
            // $username = $username;//! because of this there was problem.
            // ------------------------
            //! here need to modify for pass becuase it is stored in session
            //! instead we store id in session and use getter method to call password.
            // ---------------------------


            $currentPassword = $_SESSION['password'];
            $oldPassword = $this->crypter($oldPassword);
            $newPassword = $this->crypter($newPassword);
            $confirmPassword = $this->crypter($confirmPassword);
            // $this->printr($confirmPassword);
            $message = ""; // Set an empty string as default

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
                // echo $newPassword;die;
                $connexion = $um->connexion();
                $sql = "UPDATE user SET password = ? WHERE username = ?";
                $request = $connexion->prepare($sql);
                $success = $request->execute([$newPassword, $username]);
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
    //todo----------------------------------showFormChangePass()----------------------------------
    function changeUserPass()
    {
        $file = "View/user/formChangePassword.html.php";
        $this->generatePage($file);
    }


    //todo----------------------------------seDeconnecter()----------------------------------
    function seDeconnecter()
    {
        session_destroy();
        header('location:accueil');
    }
    //todo-------------------------------------valider----------------------------------
    //!new created function findOneByCondition is called here.

    function valider($data)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $um = new UserManager();
            extract($data);
            // $this->printr($data);die;
            if (empty($username) || empty($password)) {
                $message = "<p class='red text-center'>Identifiant ou mot de passe ne doit pas être vide</p>";
                $variables = [
                    'message' => $message,
                ];
                $file = "View/user/formLogin.html.php";
                $this->generatePage($file, $variables);
            } else {
                //! The sql has been moved to manager.
                // $connexion = $um->connexion();
                // $sql = "select * from user where (username=? or email=?) and password = ?";
                // $requete = $connexion->prepare($sql);
                // // $requete->execute([$username, $username, sha1($password)]);
                // $requete->execute([$username, $username, $this->crypter($password)]);
                // $user = $requete->fetch(PDO::FETCH_ASSOC);
                // //!here instead of sha1 we called the function crypter
                $dataCondition = [
                    'username' => $username,
                    'password' => $this->crypter($password)
                ];
                $user = $um->findOneByCondition($dataCondition);

                // The search on username has proven to be false, so we attempt the search on email.
                //todo Meaning user can use either email or username

                if (!$user->getUsername()) {
                    $dataCondition = [
                        'email' => $username,
                        'password' => $this->crypter($password)
                    ];
                    $user = $um->findOneByCondition($dataCondition);
                }
                if ($user) {
                    $_SESSION['username'] = $user->getUsername();
                    $_SESSION['roles'] = $user->getRoles();
                    $_SESSION['bg_navbar'] = "bg-success";
                    $_SESSION['password'] = $user->getPassword();
                    $_SESSION['id'] = $user->getId();
                    header('location:accueil');
                    exit();
                } else {
                    $message = "<p class='red text-center'>Identifiant ou mot de passe incorrect</p>";
                    $variables = [
                        'message' => $message,
                    ];
                    $file = "View/user/formLogin.html.php";
                    $this->generatePage($file, $variables);
                }
            }
        }
    }
    //todo-------------------------------------userLogin----------------------------------

    function seConnecter()
    {
        $um = new UserManager();
        $file = "View/user/formLogin.html.php";
        $this->generatePage($file);
    }
    //todo------------------------------------- SearchUser----------------------------------
    function searchUser($mot)
    {
        $um = new UserManager();
        $keys = ['username'];
        $users = $um->search($keys, $mot);

        $listUsers = []; // Initialize an empty array to store user data

        foreach ($users as $user) {
            // Create a User object for each user in the result
            $userObject = new User($user);

            $dateCreation = $userObject->getDateCreation();
            $dateCreation = new DateTime($dateCreation);
            $dateCreation = $dateCreation->format('d/m/Y');

            $roles = json_decode($userObject->getRoles());
            $role_title = implode(" - ", $roles);

            $user_role = "<select class='form-select' title ='$role_title'> ";
            foreach ($roles as $role) {
                $user_role .= "<option>$role</option>";
            }
            $user_role .= "</select>";

            $listUsers[] = [
                'id' => $userObject->getId(),
                'username' => $userObject->getUsername(),
                'dateCreation' => $dateCreation,
                'roles' => $user_role,
            ];
        }

        $variables = [
            'listUsers' => $listUsers,
            'nbre' => count($listUsers)
        ];

        $files = "View/user/listUser.html.php";
        $this->generatePage($files, $variables);
    }

    //todo-------------------------- GenerateFormUser----------------------------------
    function generateFormUser($user, $disabled)
    {
        $user_roles = $user->getRoles();
        $rm = new RoleManager();
        $myRoles = $rm->showAll(); //! $myRoles has following data of associative array.
        //? [
        //?     ['id' => 1, 'rang' => '001', 'libelle' => 'ROLE_ADMIN'],
        //?     ['id' => 2, 'rang' => '002', 'libelle' => 'ROLE_ASSISTANT'],
        //?     ['id' => 3, 'rang' => '003', 'libelle' => 'ROLE_DEV'],
        //?     ['id' => 4, 'rang' => '004', 'libelle' => 'ROLE_USER']
        //? ]
        $roles = [];
        foreach ($myRoles as $myRole) {
            $libelle = $myRole['libelle'];
            if (in_array($libelle, $user_roles)) {
                $selected = "selected";
                //!added check box here
                $checked = "checked";
            } else {
                $selected = "";
                $checked = "";
            }
            $roles[] = ['libelle' => $libelle, 'selected' => $selected, 'checked' => $checked];
        }
        //------preparation variables------
        $variables = [
            'id' => $user->getId(),
            'username' => $user->getUsername(),
            'password' => '***********',
            'email' => $user->getEmail(),
            'roles' => $roles,

            // 'roles'=>json_decode($user->getRoles()),
            'disabled' => $disabled,
        ];

        $file = "View/user/formUser.html.php";
        $this->generatePage($file, $variables);
    }

    //todo------------------------------------- DeleteUser----------------------------------
    function deleteUser($id)
    {
        $um = new UserManager();
        $um->deleteById($id);
        header('location:user');
        exit;
    }

    //todo------------------------------------- InsertUser----------------------------------
    function insertUser()
    {
        //---role---------
        $user = new User();
        $user->setRoles(['ROLE_USER']); //! minimum user created should have one role 
        $user_roles = $user->getRoles();
        $disabled = "";
        $this->generateFormUser($user, $disabled);
    }

    //todo------------------------------------- ShowUser----------------------------------
    function showUser($id) //!here id =1
    {
        //---User------
        $um = new UserManager();  //! UserManager is instantiated to call func findByID($id)
        $user = $um->findById($id); //!<--Now $user has code,email,password,roles with values and $um has gettersetter also.
        $user_roles = $user->getRoles();
        $user_roles = json_decode($user_roles); //!we transform just roles coz email,pass,code is string.
        $user->setRoles($user_roles);
        //! The setRoles() method is called on the User object to update the roles property with the decoded roles.
        $disabled = "disabled";
        $this->generateFormUser($user, $disabled);
    }

    //todo------------------------------------- SaveUser----------------------------------
    function saveUser($data)
    {
        //  $this->printr($data); // this is to print before valider
        $um = new UserManager();
        $connexion = $um->connexion();
        extract($data);

        $data['roles'] = json_encode($data['roles']); //transform just role inside data in json string
        //after transforming in json it looks ["ROLE_ADMIN","ROLE_DEV","ROLE_USER"]
        $data['password'] = $this->crypter($data['password']); //crypting password
        //  $this->printr($data);die;// this will print the changed result after validing.!!imp
        $id = (int) $id; //transformation de $id en integer entier
        if ($id != 0) {   // cas modification
            $um->update($data, $id);
        } else {
            $um->insert($data);
        }
        header('location:user');
    }

    //todo------------------------------------- updateUserModifiedVerson----------------------------------
    function updateUser($id) //!here id =1
    {
        //---User------
        $um = new UserManager();  //! UserManager is instantiated to call func findByID($id)
        $user = $um->findById($id); //!<--Now $user has code,email,password,roles with values and $um has gettersetter also.
        $user_roles = $user->getRoles();
        $user_roles = json_decode($user_roles);
        $user->setRoles($user_roles); //!we transform just roles coz email,pass,code is string.
        $disabled = "";
        $this->generateFormUser($user, $disabled);
    }

    //todo------------------------------------- listUser----------------------------------
    function listUser()
    {
        // if ($this->notGranted('ROLE_ADMIN')) {
        //     $this->throwMessage('You dont have rights to use this action');
        // }
        //!--------protection in url.
        if($this->notgranted('ROLE_ADMIN')) $this->throwMessage('You dont have right to use this action');
        $um = new UserManager();
        $users = $um->showAll();
        //! here all the keys and user from table user is stored in $users.
        //!Now $users has 
        //? $users = [
        //     [
        //         'id'=>1,
        //     'username'=>'sherpa',
        // ],
        // [
        //     'id'=>2,
        //     'username'=>'paul', and so on
        // ]
        //? ]
        $listUsers = []; //!empty array is created to store the processed user data.
        foreach ($users as $user) {
            //? The foreach loop begins, taking the first user's data from the $users array.
            $user = new User($user);
            //? A new User object is created with this user's data. This gives you access to the User class's methods
            //?  for this user.Because data of this user is passed in construct $data array.
            $dateCreation = $user->getDateCreation();
            $dateCreation = new DateTime($dateCreation);
            $dateCreation = $dateCreation->format('d/m/Y');
            //? The user's creation date is retrieved using the getDateCreation() method, converted into a DateTime 
            //? object, and then formatted into 'd/m/Y' format.
            //!------------Afficher roles en menu deroulant.
            $roles = json_decode($user->getRoles());
            // $role_title = implode(', ', $roles); //transform the table $role in text with 
            if(is_array($roles)){
                $role_title=implode(', ',$roles);
            }
            //? The user's roles, stored as a JSON string, are decoded into a PHP array using json_decode().
            //? Now $roles = array("ROLE_ADMIN", "ROLE_ASSIST", "ROLE_DEV", "ROLE_USER")
            //*json string looks like this '["ROLE_ADMIN","ROLE_ASSIST","ROLE_DEV","ROLE_USER"]'

            $user_role = "<select class='form-select'  title ='$role_title'> ";
            //? A HTML select element is created and stored in $user_role var with the user's roles as options.
            foreach ($roles as $role) {
                $user_role .= "<option>$role</option>";
                //after complete loop $user_role = <option>ROLE_ADMIN</option><option>ROLE_ASSIST</option> AND SO ON.
            }
            $user_role .= "</select>"; //? final html looks like this below:
            // <select class='form-select'>
            //     <option>ROLE_ADMIN</option>
            //     <option>ROLE_ASSIST</option>
            //     <option>ROLE_DEV</option>
            //     <option>ROLE_USER</option>
            // </select>

            $listUsers[] = [
                'id' => $user->getId(),
                'username' => $user->getUsername(),
                'dateCreation' => $dateCreation,
                'roles' => $user_role,
            ];
            //? An associative array is created with the user's id, username, formatted creation date, and the HTML select
            //?  element. This array is then added to the $listUsers array.
        }
        $variables = [
            'listUsers' => $listUsers,
            'nbre' => count($listUsers)
        ];
        $files = "View/user/listUser.html.php";
        $this->generatePage($files, $variables);
    }
}
