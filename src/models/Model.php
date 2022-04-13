<?php

class Model
{
    // TODO: Clean up the Model Class
    
    protected $_bdd;
    // Connection à la base de données
    private function setBdd(){
        $this->_bdd = new PDO('mysql:host=localhost;dbname=chemaouelfihri;charset=utf8', 'root', '');

        // Utiliser les constantes de PDO pour gérer les erreurs 
        $this->_bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }

    // Avoir la bdd
    protected function getBdd(){
        if($this->_bdd == null){
            $this->setBdd();
            return $this->_bdd;
        }
    }

    protected function queryObjects($query, $options ,$obj){
        $this->getBdd(); 
        $var = [];
        $req = $this->_bdd->prepare($query);
        $req->execute($options);

        // Variable data qui va contenir les données
        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            // var contient les données sous forme d'objets
            $var[] = new $obj($data);
        }
        return $var;
        $req->closeCursor();
    }    

    // Methode de récupération de la liste d'elements
    protected function getAll($table, $obj){
        $this->getBdd(); 
        $var = [];
        $req = $this->_bdd->prepare('SELECT * FROM '.$table.' ORDER BY id desc');
        $req->execute();

        // Variable data qui va contenir les données
        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            // var contient les données sous forme d'objets
            $var[] = new $obj($data);
        }
        return $var;
        $req->closeCursor();
    }

    protected function getAllById($table, $obj, $id){
        $this->getBdd();
        $var = [];
        $req = $this->_bdd->prepare('SELECT * FROM '.$table.' WHERE id = ?');
        $req->execute(array($id));
        // Variable data qui va contenir les données
        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            // var contient les données sous forme d'objets
            $var[] = new $obj($data);
        }
        return $var;
        $req->closeCursor();      
    }

}
