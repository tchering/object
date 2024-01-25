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
// $cm = new ClientManager();
// $columnLikes = ['numClient', 'nomClient', 'adresseClient'];
// $mot = "c";
// $clients = $cm->search($columnLikes, $mot);
// MyFct::sprintr($clients);

// http://localhost/object/demo.php

$cm = new ClientManager();
// $dataCondition = [
//     'numClient'=>'CL001',
//     'nomClient'=>'Sonam sherpa',
// ];
$client1 = $cm->findAllByConditionTable('client',[],"order by nomClient desc");
printr($client1);
// $client2 = $cm->findOneByCondition($dataCondition);
// printr($client2);
