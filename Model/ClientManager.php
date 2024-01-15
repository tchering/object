<?php 

class ClientManager extends Manager{
    public function  getDescribe() {
        return $this->getDescribeTable('client');
    }
    public function findById($id){
        return $this->findByIdTable('client',$id);
    }
    public function showAll(){
        $result = $this->listTable('client');
        return $result;
    }
}