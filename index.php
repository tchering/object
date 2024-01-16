<?php
include("./Service/extra.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//standard PHP library
spl_autoload_register('charger');
//this method is more secure and recommended.
$path ="accueil";
extract($_GET);
// $path = isset($_GET['path']) ? $_GET['path'] : '';

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
