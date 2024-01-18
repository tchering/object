<?php
class UserController extends MyFct
{
    public function __construct()
    {
        $action = "list";
        extract($_GET);
        switch ($action) {
            case "list":
                $this->listerUser();
                break;
            case "insert":
                break;
            case "update":
                $this->updateUser($id);
                break;
            case "show":
                break;
            case "delete":
                break;
            case "save":
                break;
            case "search":
                break;
        }
    }

    // My functions 
    function updateUser($id)
    {
        //---User------
        $um = new UserManager();
        $user = $um->findById($id);
        $user_roles = json_decode($user->getRoles());
        //---role---------
        $rm = new RoleManager();
        $myRoles = $rm->showAll();
        $roles = [];
        foreach ($myRoles as $role) {
            if (in_array($role, $user_roles)) {
                $selected = "selected";
            } else {
                $selected = "";
            }
            $roles[] = [$role, $selected];
        }

        //------preparation variables------
        $variables = [
            'id' => $user->getId(),
            'username' => $user->getUsername(),
            'password' => '',
            'email' => $user->getEmail(),
            'roles' => $roles,
            'disabled' => '',
        ];

        $file = "View/user/formUser.html.php";
        $this->generatePage($file, $variables);
    }
    function listerUser()
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
