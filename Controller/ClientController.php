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
                // gets url from list.html.php afficher button.
                // index.php know which controller to execute in this case Client Controller.
                // extract get extracts the variable 
                $this->showClient($id);
                break;
            case 'update':
                $this->updateClient($id);
                break;
            case 'insert':
                $this->insertClient();
                break;
            case 'save': //this is defined in form.html.php 
                //todo A:when case save is called then it execute saveClient function
                $this->saveClient($_POST); //!here the data is sent via post method so there is post
                break;
            case 'delete':
                $this->deleteClient($id);
                break;
                //!search function is here
            case 'search':
                $this->searchClient($mot);
                break;
        }
    }

    //!---------------------My Functions

    //! here all the data passed via url are stored inside $data.
    function searchClient($mot){
        $cm = new ClientManager();
        $columnLikes=['numClient','nomClient','adresseClient'];
       $clients=$cm->search($columnLikes,$mot);
       $variables = [
        'clients'=>$clients,
        'nbre'=>count($clients),
       ];
       $file ="View/client/list.html.php";
       $this->generatePage($file,$variables);
    }
    function deleteClient($id)
    {
        $cm = new ClientManager();
        $cm->deleteById($id);
        header("location:client");
        exit();
    }
    function insertClient()
    {
        //!Here we dont need to instantiate ClientManager coz we dont have any function in ClientManager that we need.
        $variables = [
            'id' => '',
            'numClient' => '',
            'nomClient' => '',
            'adresseClient' => '',
            'disabled' => '',
        ];
        $file = "View/client/form.html.php";
        $this->generatePage($file, $variables);
    }
    function saveClient($data)
    {
        //todo B: ClientManager is instantiate to have access to database connection.
        $cm = new ClientManager();
        $connexion = $cm->connexion();
        extract($data);
        //todo C: extract will transform $data in associative array with key and values.
        //todo once extracted the $data becomes 
        // $data = [
        //     'id'=>1,
        //     'numClient'=>'CL001',
        //     'nomClient'=>'Sonam Sherpa',
        //     'adresseClient'=>'Avignon'
        // ];
        //todo D: Now there is 2 case if id !=0 then it will call the update($data,$id); else insert.In our case update is called
        $id = (int) $id; //transformation de $id en integer entier
        if ($id != 0) {   // cas modification
            //!The function update is called here from ClientManager.   
            //todo E: Now inside param the extracted $data and $id are sent with it. Check ClientManager function update.  
            $cm->update($data, $id);
        } else {
            //! The function insert is called here from ClientManager.
            $cm->insert($data);
        }
        header('location:client');
    }
    function updateClient($id)
    {
        $cm = new ClientManager();
        $client = $cm->findById($id);
        $variables = [
            'id' => $client->getId(),
            'numClient' => $client->getNumClient(),
            'nomClient' => $client->getNomClient(),
            'adresseClient' => $client->getAdresseClient(),
            'disabled' => '',
        ];

        $file = "View/client/form.html.php";
        $this->generatePage($file, $variables);
    }
    function showClient($id)
    {
        $cm = new ClientManager();
        //!when we call findById in instance Of ClientManager it has access to Client.php getter setter method  aswell because we have created instance of Client.php class in ClientManager.php page
        $client = $cm->findById($id);
        $variables = [
            'id' => $client->getId(),
            'numClient' => $client->getNumClient(),
            'nomClient' => $client->getNomClient(),
            'adresseClient' => $client->getAdresseClient(),
            'disabled' => 'disabled',
        ];
        // $this->printr($variables);die;
        //------Preparation a l'ouverture de la page---------
        $files = "View/client/form.html.php";
        //! Here we have used directly $this to generate page because we have used extend MyFct so all the methods from MyFct class belongs to this class aswell. So in the instance of this class search me generatePage function.
        $this->generatePage($files, $variables);
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
