<?php
class ClientController
{
    //!A constructor is a special type of method that is automatically called when an object of a class is created. In this case, when an instance of ClientController is created with $page = new $nameController(); in this file, the constructor is automatically called.

    //! Within the constructor of ClientController, it's setting $action to 'list', then using a switch statement to handle different actions. In the case of 'list', it creates a new ClientManager, calls the showAll method to get all articles, and then calls the generatePage method.
    public function __construct()
    {
        $action = "list";
        extract($_GET);
        switch ($action) {
            case 'list':
                $this->listClient();
                break;
            case 'show':
                break;
        }
    }
    // mes function 
    function listClient()
    {
        $cm = new ClientManager();
        $clients = $cm->showAll();
        $variables = [
            'clients' => json_encode($clients),
        ];
        $files = "View/client/list.html.php";
        $myFct = new MyFct();
        $myFct->generatePage($files, $variables);
    }
    function showClient($id)
    {
        $cm = new ClientManager();
    }
}
