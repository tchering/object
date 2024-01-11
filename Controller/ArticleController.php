<?php

class ArticleController extends MyFct
{
    public function __construct()
    {
        $action = 'list';
        //! here we are extracting <a href="index.php?path=article"> From base-bs.html.php
        extract($_GET);
        switch ($action) {
            case 'list':
                $am = new ArticleManager();
                $articles = $am->findAll();
                $file = "view/article/list.html.php";
                // $variable=[
                //   'articles'=>json_encode($articles)
                // ];
                // $this->generatePage($file,$variable);
                //!this below code is same as above commented code.
                $this->generatePage($file, ['articles' => json_encode($articles)]);
                break;
        }
    }
    //-------My Methods-----------
}
