<?php

class Article extends ArticleManager
{
    private $id;
    private $numArticle;
    private $designation;
    private $prixUnitaire;

    public function __construct($data = [])
    {
        if ($data) {
            foreach($data as $key=>$valeur){
                //creation de fonction set
                $set ="set".ucFirst($key) ;  //cas ou $key='numArticle' alors $set ="setNumArticle" 

                if(method_exists($this,$set)){
                    $this->$set($valeur);
                }
            }
        }
    }

    // Getter method for retrieving the value of $id
    public function getId()
    {
         $result =$this->id;
         return $result;
    }

    // Setter method for assigning a value to $id
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getNumArticle()
    {
        return $this->numArticle;
    }

    public function setNumArticle($numArticle)
    {
        $this->numArticle = $numArticle;

        return $this;
    }

    public function getDesignation()
    {
        return $this->designation;
    }

    public function setDesignation($designation)
    {
        $this->designation = $designation;

        return $this;
    }


    public function getPrixUnitaire()
    {
        return $this->prixUnitaire;
    }


    public function setPrixUnitaire($prixUnitaire)
    {
        $this->prixUnitaire = $prixUnitaire;

        return $this;
    }
}
