<?php

abstract class Model
{
    private static $_bdd;

    // Connection à la base de données
    private static function setBdd(){
        self::$_bdd = new PDO('mysql:host=localhost;dbname=chemaouelfihri;charset=utf8', 'root', '');

        // Utiliser les constantes de PDO pour gérer les erreurs 
        self::$_bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }

    // Avoir la bdd
    protected function getBdd(){
        if(self::$_bdd == null){
            self::setBdd();
            return self::$_bdd;
        }
    }

    // Methode de récupération de la liste d'elements
    protected function getAll($table, $obj){
        $this->getBdd(); 
        $var = [];
        $req = self::$_bdd->prepare('SELECT * FROM '.$table.' ORDER BY id desc');
        $req->execute();

        // Variable data qui va contenir les données
        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            // var contient les données sous forme d'objets
            $var[] = new $obj($data);
        }
        return $var;
        $req->closeCursor();
    }

}
