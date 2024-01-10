<?php

class ArticleManager extends Manager
{
    public function getDescribe()
    {
        $resultat = $this->getDescribeTable('article');
        return $resultat;
    }
    public function findById($id)
    {
        $resultat = $this->findByIdTable('article', $id);
        return $resultat;
    }
    public function deleteById($id){
        $this->deleteByIdTable('article',$id);
    }
    public function findAll(){
        $resultat = $this->listTable('article');
        return $resultat;
    }
    public function statisticVente(){
        
    }
}
