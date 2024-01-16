<?php


//! In PHP, the extends keyword is used to create a class that inherits from another class. This is known as class inheritance or subclassing.
class ArticleManager extends Manager
{
    public function getDescribe()
    {
        //! When you call $this->getDescribeTable('article') inside the ArticleManager class, PHP first looks for a method named getDescribeTable in ArticleManager. If it doesn't find one, it then looks in the parent class, Manager.
        $resultat = $this->getDescribeTable('article');
        return $resultat;
    }
    //! by default if we dont put type then it is object
    //! here table article is associative array with index and we are transforming array in object.
    public function findById($id, $type = 'object')
    {
        $resultat = $this->findByIdTable('article', $id);
        if ($type) {
            $obj = new Article($resultat);
            return $obj;
        } else {
            return $resultat;
        }
    }
    //!This function findById() below is showing just associative array.
    // public function findById($id)
    // {
    //     $resultat = $this->findByIdTable('article', $id);
    //     return $resultat;
    // }
    public function deleteById($id)
    {
        $this->deleteByIdTable('article', $id);
    }
    public function findAll($type = 'object')
    {
        $resultat = $this->listTable('article');
        if ($type) {
            $obj = new Article();
            return $obj;
        } else {
            return $resultat;
        }
    }
    public function statisticVente()
    {
    }
}
