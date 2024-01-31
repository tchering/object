<?php

class ClientManager extends Manager
{
 
    public function findAllByCondition( $dataCondition = [], $order = '', $type = 'obj'){
        return $this->findAllByConditionTable('client',$dataCondition,$order,$type);
    }
    public function findOneByCondition( $dataCondition = [], $type = 'obj'){
        return $this->findOneByConditionTable('client',$dataCondition,$type);
    }
    //!------------ Function search is added here.
    // public function register($data)
    // {
    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //         return $this->registerClient('client', $data);
    //     }
    // }
    public function search($keys, $mot)
    {
        return  $this->searchTable('client', $keys, $mot);
    }
    public function update($data, $id)
    {
        return $this->updateTable('client', $data, $id);
    }
    //!New Function insert is added here with table 'client' and $data as param.
    public function insert($data)
    {
        return $this->insertTable('client', $data);
    }
    public function  getDescribe()
    {
        return $this->getDescribeTable('client');
    }
    //! in our case $id = 1
    //! Now findById calls another func findByIdTable with 'client'
    //! Client is instantiated to have getter setter value.
    public function findById($id, $type = "object")
    {
        $resultat = $this->findByIdTable('client', $id);
        if ($type) {
            $object = new Client($resultat); //!instance of Client class
            return $object;
        } else {
            return $resultat;
        }
    }
    public function showAll($order='')
    {
        $result = $this->listTable('client',$order);
        return $result;
    }
    public function deleteById($id)
    {
        $result = $this->deleteByIdTable('client', $id);
        return $result;
    }
}
