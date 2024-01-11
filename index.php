<?php
include("./Service/extra.php"); 

spl_autoload_register('charger');
//!instant of article
// $article=new Article();
// $articles =$article->findAll();
// MyFct::sprintr($articles);
//! instant of ArticleManager
// $articleManager = new ArticleManager();
// $id = 2;
// $article_array=$articleManager->findById($id,'array');
// $article_obj = $articleManager->findById($id,'obj');
// MyFct::sprintr($article_array);
// MyFct::sprintr($article_obj);

//? to show designation in $article_array
//why dont we use echo $article_array-> here ?
// echo $article_array['designation'] . '<br>';

//? to show designation in $article_obj
//its wrong to call article_obj['designation'];
// echo $article_obj->getDesignation();

//! this is to show all table in article in object but now showing.
$articleManager = new ArticleManager();
$article_obj = $articleManager->findAll('obj');
MyFct::sprintr($article_obj);

//! Here we are using function or method printr with 2 way.

//? this is classic method by creating new instance of class MyFct
// $myFct=new MyFct();
// $myFct->cprintr($articles);

//? this is static method without creating instance of class MyFct.
// MyFct::sprintr($article_array);
// MyFct::sprintr($article_obj);
