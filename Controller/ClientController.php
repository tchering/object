<?php
class ClientController extends MyFct
{
    public function __construct()
    {
        $action = "list";
        extract($_GET);
        switch ($action) {
            case 'list':
                $cm = new ClientManager();
                $clients = $cm->showAll();
                $varaibles = [
                    'clients' => json_encode($clients),
                ];

                $file = "View/client/list.html.php";
                $this->generatePage($file, $varaibles);
                break;
        }
    }
}
