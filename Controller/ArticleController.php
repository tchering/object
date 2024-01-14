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

                //?And also this line is saying: In the instance of this object search a method generatePage.
                //? Auto loader function is auto loading this class in index.php
                //? The instance is created in index.php in this line  $page = new $nameController();
                //? The instance inherit all the properties and methods of its parent class and aswell as MyFct because of extends MyFct above.
                $this->generatePage($file, ['articles' => json_encode($articles)]);
                break;
        }
    }
    //-------My Methods-----------
}
