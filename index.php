<?php
include("./Service/extra.php"); //! here we have separated function file in another folder service and here included extra.php from service folder

spl_autoload_register('charger'); // this is to auto include the file. with this we dont need to use include each time like above.
$article=new Article();
$articles =$article->findAll();
printr($articles);