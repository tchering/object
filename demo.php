<?php

//! This is to test function insertTable in manager
require_once("Service/extra.php");
spl_autoload_register('charger');

// $m = new Manager();
// $data = [
//     'id'=>0,
//     'numClient'=>'CLT001',
//     'nomClient'=>'JASON MAMAO',
//     'adresseClient'=>'Paris',
// ];

// $m->insertTable('client',$data);

//! This is to test function search in manager
$cm = new ClientManager();
$columnLikes = ['numClient', 'nomClient', 'adresseClient'];
$mot = "c";
$clients = $cm->search($columnLikes, $mot);
MyFct::sprintr($clients);

// http://localhost/object/demo.php