<?php

//! we have created extra.php inside folder service which contains the function.
function printr($array){
    echo "<pre>";
    print_r($array);
    echo " </pre>";
}

function charger($class){ //le parametre $class contient le nom de la class a instancier avec new
    $fileModel ="Model/$class.php"; // Exemple si $class="Article" alors $fileModel = "Model/Article.php"
    $fileController ="Controller/$class.php";
    $fileView ="View/$class.php";
    $fileService ="Service/$class.php";
    $files =[$fileModel,$fileController,$fileView,$fileService];
    foreach($files as $file){
        if(file_exists($file)){
            include($file);
        }
    }
    
}


?>