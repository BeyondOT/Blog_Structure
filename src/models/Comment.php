<?php

class Comment
{

    protected $_id;
    protected $_articleId;
    protected $_author;
    protected $_content;
    protected $_date;
    protected $_isVerified;

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

    public function setArticleId($articleId)
    {
        $articleId = (int)$articleId;
        if($articleId > 0){
            $this->_articleId = $articleId;
        }
    }

    public function setAuthor($author)
    {
        if(is_string($author)){
            $this->_author = $author;
        }
    }

    public function setContent($content)
    {
        if(is_string($content)){
            $this->_content = $content;
        }
    } 

    public function setDate($date)
    {
        $this->_date = $date;
    } 
    
    public function setIsVerified($isVerified)
    {
        $this->_isVerified = $isVerified;
    }

    // Création des getters

    public function id()
    {
        return $this->_id;
    }

    public function articleId()
    {
        return $this->_articleId;
    }

    public function author()
    {
        return $this->_author;
    }

    public function content()
    {
        return $this->_content;
    }

    public function date()
    {
        return $this->_date;
    }

    public function isVerified()
    {
        return $this->_isVerified;
    }

}