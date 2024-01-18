<?php 
class Role extends RoleManager{
    private $id;
    private $rang;
    private $libelle;

    public function __construct($data = [])
    {
        if ($data) {
            foreach ($data as $key => $valuer) {
                $set = "set" . ucFirst($key);
                if (method_exists($this, $set)) {
                    $this->$set($valuer);
                }
            }
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getRang()
    {
        return $this->rang;
    }

    public function setRang($rang)
    {
        $this->rang = $rang;

        return $this;
    }

    public function getLibelle()
    {
        return $this->libelle;
    }

    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }
}