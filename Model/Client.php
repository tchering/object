<?php

class Client
{
    private $id;
    private $numClient;
    private $nomClient; // Corrected variable name
    private $adresseClient;

    public function __construct($data = [])
    {
        // explanation $data = [
        // 'nomClient'=>'Sherpa';
        // ];
        if ($data) {
            foreach ($data as $key => $value) {
                // Creation of set function

                $set = "set" . ucfirst($key);  // Corrected function name to ucfirst()
                //$set="set".ucFirst(nomClient) which gives $set = "setNomClient";

                if (method_exists($this, $set)) { //if yes it exists
                    $this->$set($value);
                    // $this->setNomClient('Sherpa');
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
    }

    public function getNumClient()
    {
        return $this->numClient;
    }

    public function setNumClient($numClient)
    {
        $this->numClient = $numClient;
        return $this;
    }

    public function getNomClient()
    {
        return $this->nomClient;
    }

    public function setNomClient($nomClient)
    {
        $this->nomClient = $nomClient;
        return $this;
    }

    public function getAdresseClient()
    {
        return $this->adresseClient;
    }

    public function setAdresseClient($adresseClient)
    {
        $this->adresseClient = $adresseClient;
        return $this;
    }
}
