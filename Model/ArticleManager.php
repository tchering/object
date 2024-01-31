<?php


//! In PHP, the extends keyword is used to create a class that inherits from another class. This is known as class inheritance or subclassing.
class ArticleManager extends Manager
{
    public function findAllByCondition( $dataCondition = [], $order = '', $type = 'obj'){
        return $this->findAllByConditionTable('article',$dataCondition,$order,$type);
    }
    public function findOneByCondition( $dataCondition = [], $type = 'obj'){
        return $this->findOneByConditionTable('article',$dataCondition,$type);
    }
    //!------------ Function search is added here.
    // public function register($data)
    // {
    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //         return $this->registerArticle('article', $data);
    //     }
    // }
    public function search($keys, $mot)
    {
        return  $this->searchTable('article', $keys, $mot);
    }
    public function update($data, $id)
    {
        return $this->updateTable('article', $data, $id);
    }
    //!New Function insert is added here with table 'article' and $data as param.
    public function insert($data)
    {
        return $this->insertTable('article', $data);
    }
    public function  getDescribe()
    {
        return $this->getDescribeTable('article');
    }
    //! in our case $id = 1
    //! Now findById calls another func findByIdTable with 'article'
    //! Article is instantiated to have getter setter value.
    public function findById($id, $type = "object")
    {
        $resultat = $this->findByIdTable('article', $id);
        if ($type) {
            $object = new Article($resultat); //!instance of Article class
            return $object;
        } else {
            return $resultat;
        }
    }
    public function showAll($order='')
    {
        $result = $this->listTable('article',$order);
        return $result;
    }
    public function deleteById($id)
    {
        $result = $this->deleteByIdTable('article', $id);
        return $result;
    }
}
