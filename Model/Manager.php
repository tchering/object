<?php
require_once("config/parametre.php");

class Manager
{
    function findAllByConditionTable($table, $dataCondition = [], $order = '', $type = 'obj')
    //$order assure le classement du resultats.
    {
        $connexion = $this->connexion();
        $condition = "";
        $values = [];
        foreach ($dataCondition as $key => $value) {
            if ($condition == "") {
                $condition .= "$key = ?";
            } else {
                $condition .= " and $key = ?";
            }
            $values[] = $value;
        }
        $condition = (!$condition) ? "true" : $condition;

        $sql = "select * from $table where $condition $order";
        $requete = $connexion->prepare($sql);
        $requete->execute($values);
        $resultats = $requete->fetchAll(PDO::FETCH_ASSOC);
        if ($type) {
            $class = ucfirst($table);
            $objs = [];
            foreach ($resultats as $value) {
                $obj = new $class($value);
                $objs[] = $obj;
            }
            return $objs;
        } else {
            return $resultats;
        }
    }
    //! la fonction nous permet faire une recherche suivant le contenue de $dataCondition.
    function findOneByConditionTable($table, $dataCondition = [], $type = 'obj')
    {
        $connexion = $this->connexion();
        $condition = "";
        $values = [];
        foreach ($dataCondition as $key => $value) {
            if ($condition == "") {
                $condition .= "$key = ?";
            } else {
                $condition .= " and $key = ?";
            }
            $values[] = $value;
        }
        //! with this condition if no $dataCondition is given then fetch will fetch the first element.
        $condition = (!$condition) ? "true" : $condition;

        $sql = "select * from $table where $condition";
        $requete = $connexion->prepare($sql);
        $requete->execute($values);
        $result = $requete->fetch();
        //! here we have instantiated $table so in userController we can use $this->getName or anything.
        //! If we don't instantiate the class, then we have to use $result['name'] or $result->name.

        if ($type) {
            $class = ucfirst($table);
            $obj = new $class($result);
            return $obj;
        } else {
            return $result;
        }
    }
    function registerUser($table, $data)
    {
            $myfct = new MyFct();
            $connexion = $this->connexion();
            extract($data);
            // printr($data);die;
            $column = "";
            $pi = "";
            $values = [];
            $message="";
            foreach ($data as $key => $value) {
                if($key =='password' || $key =='confirmPassword')  {
                    $value=$myfct->crypter($value);
                }
                if ($column == "") {
                    $column .= "$key";
                    $pi .= "?";
            } else {
                $column .= ",$key";
                $pi .= ",?";
            }
            $values[] = $value;
        }
        $connexion = $this->connexion();

        if (empty($username) || empty($email) || empty($password)) {
            $message = "<p class='red text-center'>All fields are required</p>";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $message = "<p class='red text-center'>Invalid email format</p>";
        } elseif ($password !== $confirmPassword) {
            $message = "<p class='red text-center'>The password does not match</p>";
        } else {
            // Check if username already exists
            $sql = "SELECT * FROM $table WHERE username = ?";
            $request = $connexion->prepare($sql);
            $request->execute([$username]);
            $result = $request->fetch();
            
            if ($result) {
                $message = "<p class='red text-center'>Username already registered</p>";
            } else {
                $message ="";
                $sql = "INSERT INTO $table ($column) VALUES ($pi)";
                $request = $connexion->prepare($sql);
                $request->execute($values);
                if ($request->rowCount() > 0) {
                    $message = "<p class='text-center text-success'>You have been successfully registered</p>";
                } else {
                    $message = "<p class='text-center text-danger'>Registration failed</p>";
                }
            }
        }
        
        return $message;
    }

    // !----------New function search table is created here---------------------------------------
    // public function searchTable($table, $columnLikes, $mot)
    // {
    //     $connexion = $this->connexion();
    //     $condition = "";
    //     $values = [];
    //     foreach ($columnLikes as $value) {
    //         $condition .= ($condition == "") ? "$value like ?" : " or $value like ?";
    //         // if ($condition == "") {
    //         //     $condition .= "$value like ?";
    //         // } else {
    //         //     $condition .= " or $value like ?";
    //         // }
    //         $values[] = "%$mot%";
    //     }
    //     $sql = "select * from $table where $condition";
    //     //!--------test-------------------
    //     // echo $sql;
    //     // MyFct::sprintr($values);
    //     //!---------------------------------
    //     $requete = $connexion->prepare($sql);
    //     $requete->execute($values);
    //     $resultat = $requete->fetchAll(pdo::FETCH_ASSOC);
    //     return $resultat;
    // }

    function searchTable($table, $keys, $mot)
    {
        $connexion = $this->connexion();
        $condition = "";
        $searchQuery = [];

        // Iterate through the keys to fill the condition and values array
        foreach ($keys as $key) {
            if ($condition == "") {
                $condition .= "$key LIKE ?";
            } else {
                $condition .= " OR $key LIKE ?";
            }
            $searchQuery[] = "%$mot%";
        }

        $sql = "SELECT * FROM $table WHERE $condition";
        $requete = $connexion->prepare($sql);
        $requete->execute($searchQuery);
        $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
        return $resultat;
    }
    //!---------- New function to update table is created here to not use sql in clientController

    //todo G:In our case client In this updateTable we know $table is client,$data is [array] and $id=1
    // insert into client(numClient,nomClient,adresseClient) values (?,?,?);
    //?            $table,           $column                 $values   $pi
    public function updateTable($table, $data, $id)
    //todo we have $data = ['id'=>1,'numClient'='CL001','nomClient'='Sonam Sherpa','adresseClient'='Avignon'];
    {
        $connexion = $this->connexion();
        $column = ""; //here column and $values are variable where we will store the column and values.
        $values = [];
        foreach ($data as $key => $value) {
            if ($key != 'id') {
                //$column.=($column=="")?"$key=?":",$key=?"; //! ternary operator
                if ($column == "") {
                    $column .= "$key=?"; //.= appends right side operands to left side operand
                    //! now first loop gives $column='numclient=?'
                } else {
                    //! if not empty it push next value.
                    $column .= ",$key=?";
                }
                $values[] = $value; //!here this like push in js.$value is pushed in $values=[];
                //! here first loop gives $values[] = 'CL001';
                //todo The loop iterates 3 times in our case and after loop terminate,we get
                //?$column = "numClient=?,nomClient=?,adresseClient=?"
                //? $values = ['CL001', 'Sonam Sherpa', 'Avignon'].
            }
        }
        //todo H:Now it construct sql statements.
        $sql = "update $table set $column where id=?";
        $values[] = $id; //here value of  $id will be pushed in $values array.
        $requete = $connexion->prepare($sql);
        $requete->execute($values);
    }
    //!---------- New function insertTable is created here to not use sql in clientController.
    public function insertTable($table, $data)
    {
        // $data = [
        // 'id'=>,
        // 'numClient'=>'CLT001',
        // 'nomClient'=>'Sherpa',
        // 'adresseClient'=>'Paris',
        // ];
        // insert into client(numClient,nomClient,adresseClient) values (?,?,?);
        //?            $table,           $column                 $values   $pi
        //!---initialization de variables.
        $connexion = $this->connexion();
        $column = "";
        $pi = ""; // les point d'interrogation
        $values = []; // this is value when user will insert data will is associative array.
        //!we we generate request sql.
        foreach ($data as $key => $value) {
            if ($key != 'id') {
                if ($column == "") {
                    $column .= $key;
                    $pi .= "?";
                } else {
                    $column .= ",$key";
                    $pi .= ",?";
                }
                $values[] = $value;
            }
        }
        $sql = "insert into $table($column) values ($pi)";
        //!this is to test .the data is passed in demo.php
        // MyFct::sprintr($sql);
        // MyFct::sprintr($values); die;
        $requete = $connexion->prepare($sql);
        $requete->execute($values);
    }

    public function getDescribeTable($table)
    {
        $connexion = $this->connexion();
        $sql = "desc $table";  // requete pour affichage de la structure la table collaborateur
        $requete = $connexion->prepare($sql);
        $requete->execute();
        $colonnes = $requete->fetchAll(PDO::FETCH_COLUMN); // recuperation de tous les noms de colonne de la table collaborateur
        /* sans avoir une bonne methode on devait initialiser la variavle tableau en :
        $variables=[
            'id'=>'',
            'civilite'=>'',
            'nom'=>'',
        ];*/
        $variables = [];
        foreach ($colonnes as $valeur) {
            $variables[$valeur] = '';
        }
        return $variables;
    }
    public function connexion($host = HOST, $dbname = DBNAME, $user = USER, $password = PASSWORD)
    {
        $dns = "mysql:host=$host;dbname=$dbname;charset=utf8";
        try {
            $connexion = new PDO($dns, $user, $password);
        } catch (Exception $e) {
            echo "<h1> Connexion impossible ! Verifiez les paramètres !</h1>";
            die;
        }
        return $connexion;
    }
    public function findByIdTable($nomTable, $id)
    {
        $connexion = $this->connexion();  // valeur retouner par la fontion connexion() du fichier myFct.
        $sql = "select * from $nomTable where id=?";  // Ecrire la requete sql correspondante
        $requete = $connexion->prepare($sql);   //  Dire à php de oreparer la requete sql
        $requete->execute([$id]);  // Executer la requete avec id= $id
        $resultat = $requete->fetch(PDO::FETCH_ASSOC);   // Mettre dans $article l'article trouvé
        return $resultat;
    }
    public function deleteByIdTable($nomTable, $id)
    {
        $connexion = $this->connexion();
        $sql = "delete from $nomTable where id=?";
        $requete = $connexion->prepare($sql);
        $requete->execute([$id]);
        return true;
    }

    //    public function printr($tableau)
    //     {
    //         echo "<pre>";
    //         print_r($tableau);
    //         echo "</pre>";
    //     }
    function listTable($nomTable,$order='')
    {
        $sql = "select * from $nomTable $order";
        $connexion = $this->connexion();
        $requete = $connexion->prepare($sql);
        $requete->execute();
        $tables = $requete->fetchAll(pdo::FETCH_ASSOC);
        return $tables;
    }
}
