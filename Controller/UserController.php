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
                break;
            case "update":
                //! A lets say user want to modify id 1. now 1 is stored in $id and updateUser is called
                $this->updateUser($id);
                break;
            case "show":
                break;
            case "delete":
                break;
            case 'save': //this is defined in form.html.php 
                $this->saveUser($_POST); //!here the data is sent via post method so there is post
                break;
            case "search":
                break;
        }
    }

    // My functions 
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
        $listUsers = [];
        foreach ($users as $value) {
            $user = new User($value);
            $dateCreation = $user->getDateCreation();
            $dateCreation = new DateTime($dateCreation);
            $dateCreation = $dateCreation->format('d/m/Y');
            //!------------Afficher roles en menu deroulant.
            $roles = json_decode($user->getRoles()); //transformer json en tableau php

            // $json = '{"role_admin", "role_assistant", "role_dev","role_user"}'; //json-string
            $user_role = "<select class='form-select'>";
            foreach ($roles as $role) {
                $user_role .= "<option>$role</option>";
            }
            $user_role .= "</select>";

            $listUsers[] = [
                'id' => $user->getId(),
                'username' => $user->getUsername(),
                'dateCreation' => $dateCreation,
                'roles' => $user_role,
            ];
        }
        $variables = [
            'listUsers' => $listUsers,
        ];
        $files = "View/user/listUser.html.php";
        $this->generatePage($files, $variables);
    }
}
