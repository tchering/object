<?php
class UserManager extends Manager
{
    //!------------ Function search is added here.
    public function register($data)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            return $this->registerUser('user', $data);
        }
    }
    public function search($keys, $mot)
    {
        return  $this->searchTable('user', $keys, $mot);
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
    //! in our case $id = 1
    //! Now findById calls another func findByIdTable with 'user'
    //! User is instantiated to have getter setter value.
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
