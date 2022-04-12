<?php
class User
{   
    private $_id;
    private $_username;
    private $_password;
    private $_email;
    private $_isAdmin;

    public function __construct(array $data){
        $this->hydrate($data);
    }

    // Hydratation
    // Pour chaque colonne du tableau de la bdd ($key) 
    // Appel son setter
    public function hydrate(array $data){
        foreach ($data as $key => $value){
            $method = 'set'.ucfirst($key);
            if(method_exists($this, $method)){
                $this->$method($value);
            }
        }
    }

    // Creation des setters

    public function setId($id)
    {
        $id = (int)$id;
        if($id > 0){
            $this->_id = $id;
        }
    }

    public function setUsername($username)
    {
        if(is_string($username)){
            $this->_username = $username;
        }
    }

    public function setEmail($email)
    {
        if(is_string($email)){
            $this->_email = $email;
        }
    } 

    public function setPassword($password)
    {
        $this->_password = $password;
    }

    public function setIsAdmin($isAdmin)
    {
        $this->_isAdmin = $isAdmin;
    }
    
    // Création des getters

    public function id()
    {
        return $this->_id;
    }

    public function username()
    {
        return $this->_username;
    }

    public function email()
    {
        return $this->_email;
    }

    public function password()
    {
        return $this->_password;
    }

    public function isAdmin(){
        return $this->_isAdmin;
    }


}
