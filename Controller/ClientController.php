<?php
class ClientController
{
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
            'clients'=>json_encode($clients),
        ];
        $files = "View/client/list.html.php";
        $myFct = new MyFct();
        $myFct->generatePage($files,$variables);
    }
    function showClient($id)
    {
        $cm = new ClientManager();
    }
}
