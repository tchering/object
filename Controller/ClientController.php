<?php
class ClientController extends MyFct
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
                $this->afficherClient($id);
                break;
        }
    }
    // mes function 
    function afficherClient($id)
    {
            $cm = new ClientManager();
            //!when we call findById in instance Of ClientManager it has access to Client.php getter setter method  aswell because we have created instance of Client.php class in ClientManager.php page
            $client = $cm->findById($id);
            $variables = [
            'id'=>$client->getId(),
            'numClient'=>$client->getNumClient(),
            'nomClient'=>$client->getNomClient(),
            'adresseClient'=>$client->getAdresseClient(),
            'disabled'=>'disabled',
            ];
            // $this->printr($variables);die;
            //------Preparation a l'ouverture de la page---------
            $files = "View/client/form.html.php";
            //! Here we have used directly $this to generate page because we have used extend MyFct so all the methods from MyFct class belongs to this class aswell. So in the instance of this class search me generatePage function.
            $this->generatePage($files,$variables);
    }
    function listClient()
    {
        $cm = new ClientManager();
        $clients = $cm->showAll();
        $variables = [
            'clients' => json_encode($clients),
        ];
        $files = "View/client/list.html.php";
        //! If we had created instance of class MyFct then we dont need to use extend MyFct.
        $myFct = new MyFct();
        $myFct->generatePage($files, $variables);
    }
}
