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
                $this->listUser();
                break;
            case "show":
                $this->showUser($id);
                break;
            case "insert":
                $this->insertUser();
                break;
            case "update":
                //! A lets say user want to modify id 1. now 1 is stored in $id and updateUser is called
                $this->updateUser($id);
                break;
            case 'save':
                $this->saveUser($_POST);
                break;
            case "delete":
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
                
        } // This is the missing closing brace
    }

    // My functions


    //todo----------------------------------seDeconnecter()----------------------------------
    function seDeconnecter()
    {
        session_destroy();
        header('location:accueil');
    }
    //todo-------------------------------------valider----------------------------------

    function valider($data)
    {
        $um = new UserManager();
        extract($data); //! now this extract will create array of what was inside $post for example if user entered admin and pass=1234
        //! then the extract creates 2 variables $username = "admin"; $password = "1234"; and this is what we have entered in execute
        //validate username and password
        if (empty($username) || empty($password)) {
            $message = "<h1 class='text-danger'>Identifiant out mot de passe doit pas etre vide</h1>";
            $variables = [
                'message' => $message,
            ];
            $file = "View/erreur/erreur.html.php";
            $this->generatePage($file, $variables);;
        }
        $connexion = $um->connexion();
        $sql = "select * from user where (username=? or email=?) and password = ?";
        //le premier $username est pour username=? et le 2eme pour
        $requete = $connexion->prepare($sql);
        $requete->execute([$username, $username, sha1($password)]); //
        $user = $requete->fetch(PDO::FETCH_ASSOC);
        if ($user) {
            $_SESSION['username'] = $user['username'];
            $_SESSION['roles'] = $user['roles'];
            $_SESSION['bg_navbar'] = "bg-success";
            //?-----Routing user to accueil page.
            header('location:accueil');
            exit();
        } else {
            //if loggin is not success then the page will route to erreur.html.php page 
            $message = "<div class='center'>";
            $message .= "<img src ='Public/img/tenor.gif' class='img-fluid radius-50' width='25%'>";
            $message .= "</div>";
            $message .= "<p class='text-red'>Identifiant out mot de passe incorrect</p>";
            $variables = [
                'message' => $message,
            ];
            $file = "View/erreur/erreur.html.php";
            $this->generatePage($file, $variables);
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
        $data['password'] = sha1($data['password']); //crypting password
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

            $role_title = implode(" - ", $roles); //transform the table $role in text with 
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
