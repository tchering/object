<?php
require_once("config/parametre.php");

class Manager
{
    function getDescribeTable($table)
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
    function connexion($host = HOST, $dbname = DBNAME, $user = USER, $password = PASSWORD)
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
    function findByIdTable($nomTable, $id)
    {
        $connexion = $this->connexion();  // valeur retouner par la fontion connexion() du fichier myFct.
        $sql = "select * from $nomTable where id=?";  // Ecrire la requete sql correspondante
        $requete = $connexion->prepare($sql);   //  Dire à php de oreparer la requete sql
        $requete->execute([$id]);  // Executer la requete avec id= $id
        $resultat = $requete->fetch();  // Mettre dans $article l'article trouvé
        return $resultat;
    }

    function deleteByIdTable($nomTable, $id)
    {
        $connexion = $this->connexion();
        $sql = "delete from $nomTable where id=?";
        $requete = $connexion->prepare($sql);
        $requete->execute([$id]);
        return true;
    }

    function printr($tableau)
    {
        echo "<pre>";
        print_r($tableau);
        echo "</pre>";
    }
    function listTable($nomTable)
    {
        $sql = "select * from $nomTable";
        $connexion = $this->connexion();
        $requete = $connexion->prepare($sql);
        $requete->execute();
        $tables = $requete->fetchAll();
        return $tables;
    }

}
