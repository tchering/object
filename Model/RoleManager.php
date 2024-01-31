<?php

class RoleManager extends Manager
{
    //!------------ Function search is added here.
    public function search($columnLikes,$mot){
       return  $this->searchTable('role',$columnLikes,$mot);
    }
    

    public function update($data, $id)
    {
        return $this->updateTable('role', $data, $id);
    }

    //!New Function insert is added here with table 'role' and $data as param.
    public function insert($data)
    {
        return $this->insertTable('role', $data);
    }
    public function  getDescribe()
    {
        return $this->getDescribeTable('role');
    }
    public function findById($id, $type = "object")
    {
        $resultat = $this->findByIdTable('role', $id);
        if ($type) {
            $object = new Role($resultat); //!instance of Role class
            return $object;
        } else {
            return $resultat;
        }
    }
    public function showAll($order='')
    {
        $result = $this->listTable('role',$order);
        return $result;
    }
    public function deleteById($id)
    {
        $result = $this->deleteByIdTable('role', $id);
        return $result;
    }
}
