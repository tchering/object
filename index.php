<?php
include("./Service/extra.php");

spl_autoload_register('charger');
// initialization of the $path variable
$path = 'accueil';
// generating variables using the indices of $_GET. Example: $path, $action, $id, ...
extract($_GET);
// generating the controller name using $path. For example, if $path="article", then $nameController="ArticleController"
$nameController = ucfirst($path) . "Controller";
// generating the path where the file corresponding to the controller designated by $nameController is located. For example: "Controller/ArticleController.php"
$fileController = "Controller/$nameController.php";
//On test l'existance du fichier representé par $fileController
if (file_exists($fileController)) {
    $page = new $nameController();
} else {
    echo "<h1>The file $nameController does not exist</h1>";
    die;
}

