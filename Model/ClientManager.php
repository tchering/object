<?php 

class ClientManager extends Manager{
    public function  getDescribe() {
        return $this->getDescribeTable('client');
    }
    public function findById($id,$type="object"){
        $resultat = $this->findByIdTable('client',$id);
       if($type){
        $object = new Client($resultat);//!instance of Client class
        return $object;
       } else {
        return $resultat;
       }
    }
    public function showAll(){
        $result = $this->listTable('client');
        return $result;
    }
}