<?php

class ClientManager extends Manager
{
    //!------------ Function search is added here.
    public function search($columnLikes,$mot){
       return  $this->searchTable('client',$columnLikes,$mot);
    }
    
    //?Also this function update and insert in independant therefore doesnot depend on contructor settergetter in Client.php.
//todo F: Now we know this update has $data[id,numClient,nomClient & adresse] and $id=1 in our case
//todo : Also update has another function which is defined in Manager.Check Manager
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
    public function findById($id, $type = "object")
    {
        $resultat = $this->findByIdTable('client', $id);
        if ($type) {
            //!here when Client class is instantiated the $resultat is pass in its param. 
            //!We know when class is instantiated construct is auto called therefore construct is Client is called.
            //! And inside constructor the $data is empty array for now  but will be filled with the data of $resultat.
            //! Once data is true or not empty the method to gettersetter initiate.
            $object = new Client($resultat); //!instance of Client class
            return $object;
        } else {
            return $resultat;
        }
    }
    public function showAll()
    {
        $result = $this->listTable('client');
        return $result;
    }
    public function deleteById($id)
    {
        $result = $this->deleteByIdTable('client', $id);
        return $result;
    }
}
