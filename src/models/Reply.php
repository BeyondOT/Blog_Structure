<?php 
class Reply extends Comment{
    private $_commentId;

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

    public function setCommentId($commentId)
    {
        $commentId = (int)$commentId;
        if($commentId > 0){
            $this->_commentId = $commentId;
        }
    }

    public function commentId(){
        return $this->_commentId;
    }

}