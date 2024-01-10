<?php
include("./Service/extra.php"); //! here we have separated function file in another folder service and here included extra.php from service folder

spl_autoload_register('charger'); // this is to auto include the file. with this we dont need to use include each time like above.
$myFct = new MyFct();

$art =[
    'id'=>2,
    'numArticle'=>'BV0002',
    'designation'=>'Vin Listel Gris 75cl',
    'prixUnitaire'=>15.20,
];
$article = new Article($art);
$client = new Client();

$myFct->printr($article);
$myFct->printr($client);
