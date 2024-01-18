<?php
class UserController extends MyFct
{
    public function __construct()
    {
        $action = "list";
        extract($_GET);
        switch ($action) {
            case "list":
                $this->listUser();
                break;
            case "insert":
                $this->insertUser();
                break;
            case "update":
                //! A lets say user want to modify id 1. now 1 is stored in $id and updateUser is called
                $this->updateUser($id);
                break;
            case "show":
                $this->showUser($id);
                break;
            case "delete":
                $this->deleteUser($id);
                break;
            case 'save': //this is defined in form.html.php 
                $this->saveUser($_POST); //!here the data is sent via post method so there is post
                break;
            case "search":
                $this->searchUser($mot);
                break;
        }
    }

    // My functions
    function searchUser($mot)
    {
        $um = new UserManager();
        $keys = ['id', 'username,roles'];
        $um->search($keys, $mot);
        $variables = [];
        $files = "View/user/listUser.html.php";
        $this->generatePage($files, $variables);
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
            $selected = ""; // Set selected to empty initially
            $roles[] = ['libelle' => $libelle, 'selected' => $selected];
        }
        $variables = [
            'id' => "",
            'username' => "",
            'email' => "",
            'password' => "",
            "roles" => $roles,
            "disabled" => "",
        ];
        $files = "View/user/formUser.html.php";
        $this->generatePage($files, $variables);
    }
    //todo------------------------------------- SaveUser----------------------------------
    function showUser($id) //!here id =1
    {
        //---User------
        $um = new UserManager();  //! UserManager is instantiated to call func findByID($id)
        $user = $um->findById($id); //!<--Now $user has code,email,password,roles with values and $um has gettersetter also.
        $user_roles = $user->getRoles();
        $user_roles = json_decode($user_roles); //!we transform just roles coz email,pass,code is string.
        //---role---------
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
            } else {
                $selected = "";
            }
            $roles[] = ['libelle' => $libelle, 'selected' => $selected];
        }

        //!this shows only libelle that  user has.
        // foreach ($myRoles as $myRole) {
        //     $libelle = $myRole['libelle'];
        //     if (in_array($libelle, $user_roles)) {
        //         $selected = "selected";
        //         $roles[] = ['libelle' => $libelle, 'selected' => $selected];
        //     }
        // }

        //------preparation variables------
        $variables = [
            'id' => $user->getId(),
            'username' => $user->getUsername(),
            'password' => '************',
            'email' => $user->getEmail(),
            'roles' => $roles,

            // 'roles'=>json_decode($user->getRoles()),
            'disabled' => 'disabled',
        ];

        $file = "View/user/formUser.html.php";
        $this->generatePage($file, $variables);
    }

    //todo------------------------------------- SaveUser----------------------------------
    function saveUser($data)
    {
        //  $this->printr($data); // this is to print before valider
        $um = new UserManager();
        $connexion = $um->connexion();
        extract($data);
        // $data = [
        //     'id'=>1,
        //     'email'=>'CL001',
        //     'password'=>'Sonam Sherpa',
        //     'roles'=>([0]=>ROLE_admin [1]=>role_dev ,[2]=>role_user) before transforming string roles in array
        // ];
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
    //todo------------------------------------- updateUser----------------------------------
    function updateUser($id) //!here id =1
    {
        //---User------
        $um = new UserManager();  //! UserManager is instantiated to call func findByID($id)
        $user = $um->findById($id); //!<--Now $user has code,email,password,roles with values and $um has gettersetter also.
        $user_roles = $user->getRoles();
        $user_roles = json_decode($user_roles); //!we transform just roles coz email,pass,code is string.
        //---role---------
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
            } else {
                $selected = "";
            }
            $roles[] = ['libelle' => $libelle, 'selected' => $selected];
        }

        //!this shows only libelle that  user has.
        // foreach ($myRoles as $myRole) {
        //     $libelle = $myRole['libelle'];
        //     if (in_array($libelle, $user_roles)) {
        //         $selected = "selected";
        //         $roles[] = ['libelle' => $libelle, 'selected' => $selected];
        //     }
        // }

        //------preparation variables------
        $variables = [
            'id' => $user->getId(),
            'username' => $user->getUsername(),
            'password' => '',
            'email' => $user->getEmail(),
            'roles' => $roles,

            // 'roles'=>json_decode($user->getRoles()),
            'disabled' => '',
        ];

        $file = "View/user/formUser.html.php";
        $this->generatePage($file, $variables);
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
            //? The user's roles, stored as a JSON string, are decoded into a PHP array using json_decode().
            //? Now $roles = array("ROLE_ADMIN", "ROLE_ASSIST", "ROLE_DEV", "ROLE_USER")
            //*json string looks like this '["ROLE_ADMIN","ROLE_ASSIST","ROLE_DEV","ROLE_USER"]'

            $user_role = "<select class='form-select'>";
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
