<?php

class UserManager extends Manager
{
    //!------------ Function search is added here.
    public function search($columnLikes,$mot){
       return  $this->searchTable('user',$columnLikes,$mot);
    }
    

    public function update($data, $id)
    {
        return $this->updateTable('user', $data, $id);
    }

    //!New Function insert is added here with table 'user' and $data as param.
    public function insert($data)
    {
        return $this->insertTable('user', $data);
    }
    public function  getDescribe()
    {
        return $this->getDescribeTable('user');
    }
    public function findById($id, $type = "object")
    {
        $resultat = $this->findByIdTable('user', $id);
        if ($type) {
            $object = new User($resultat); //!instance of User class
            return $object;
        } else {
            return $resultat;
        }
    }
    public function showAll()
    {
        $result = $this->listTable('user');
        return $result;
    }
    public function deleteById($id)
    {
        $result = $this->deleteByIdTable('user', $id);
        return $result;
    }
}
