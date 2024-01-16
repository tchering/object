<?php

class ArticleController extends MyFct
{
    public function __construct()
    {
        $action = 'list';
        //! here we are extracting <a href="index.php?path=article"> From base-bs.html.php
        extract($_GET);
        // if (isset($action[''])) {
        //     $_GET[''];
        // }
        switch ($action) {
            case 'list':
                $this->afficher();
                break;
            case 'read':
                $this->readArticle($id);
                break;
            case 'update':
                break;
            case 'delete':
                break;
                
        }
    }
    //-------My Methods-----------
    function readArticle($id)
    {
        $am = new ArticleManager();
        $article = $am->findById($id);
        $variables = [
            'id'=>$article->getId(),
            'numArticle'=>$article->getNumArticle(),
            'designation'=>$article->getDesignation(),
            'prixUnitaire'=>$article->getPrixUnitaire(),
            'disabled'=>'disabled',
        ];
        $files = "View/article/form.html.php";
        $this->generatePage($files,$variables);
    }
    function afficher()
    {
      $am = new ArticleManager();
      $articles = $am->findAll(false);
      $file = "View/article/list.html.php";
      $variables = [
        'articles'=>json_encode($articles),
      ];
      $this->generatePage($file,$variables);
    }
}
