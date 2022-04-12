<?php

class UserManager extends Model
{

    // retourne un objet User avec les informations de l'utilisateur
    public function getUserByEmail($email){    
        return $this->queryObjects('SELECT * FROM users WHERE email = ?', [$email], 'User');
    }

    public function getUserByUsername($username){
        return $this->queryObjects('SELECT * FROM users WHERE username = ?', [$username], 'User');
    }

    public function register($username, $email, $password){
        $req = $this->_bdd->prepare('INSERT INTO users (username, email, password) VALUES (?, ?, ?)');
        if($req->execute([$username, $email, $password])){
            return true;
        }else{
            return false;
        }
    }
        
    public function login($username, $password){
        $users = $this->queryObjects('SELECT * FROM users WHERE username = ?', [$username], 'User');
        if(empty($users)){
            return false;
        }
        $user = $users[0];
        $hashedPassword = $user->password();

        if(password_verify($password, $hashedPassword)) {
            return $user;
        }else{
            return false;
        }
    }

}


