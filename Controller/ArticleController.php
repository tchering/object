<?php

class ArticleController extends MyFct
{
    public function __construct()
    {
        $action = 'list';
        //! here we are extracting <a href="index.php?path=article"> From base-bs.html.php
        // extract($_GET);
        if (isset($action[''])) {
            $_GET[''];
        }
        switch ($action) {
            case 'list':
                $this->afficher();
                break;
                case 'show':
                    
                    break;
        }
    }
    //-------My Methods-----------
    function afficherArticle($id){
       
    }
    function afficher()
    {
        $am = new ArticleManager();
        $articles = $am->findAll();
        $variables = [
            'articles' => json_encode($articles),
        ];
        $file = "View/article/list.html.php";
        $this->generatePage($file, $variables);
    }
}
