<?php

class CommentManager extends Model
{
    // methode qui recupere les articles dans la bdd
    
    public function getAllComments()
    {
        return $this->queryObjectsNoOptions('SELECT * FROM comments WHERE ORDER BY date asc', 'Comment');
    }

    public function getPendingComments()
    {
        return $this->queryObjectsNoOptions('SELECT * FROM comments WHERE isVerified = 0 ORDER BY date asc', 'Comment');
    }

    public function getVerifiedComments()
    {
        return $this->queryObjectsNoOptions('SELECT * FROM comments WHERE isVerified = 1 ORDER BY date desc', 'Comment');
    }

    public function getCommentById($id)
    {
        return $this->queryObjects('SELECT * FROM comments WHERE id = ?', [$id], 'Comment');
    }

    public function approveComment($id)
    {
        $this->getBdd();
        $req = $this->_bdd->prepare('UPDATE comments SET isVerified = 1 WHERE id = ?');
        if($req->execute([$id])){
            return true;
        }else{
            return false;
        }
    }

    public function deleteComment($id)
    {
        $this->getBdd();
        $req = $this->_bdd->prepare('DELETE FROM comments WHERE id = ?');
        if($req->execute([$id])){
            return true;
        }else{
            return false;
        }
    }

    public function getCommentsByArticleId($id)
    {
        return $this->queryObjects("SELECT * FROM comments WHERE articleId = ? AND isVerified = 1 ORDER BY date desc",[$id], 'Comment');
    }

    public function addComment($data){
        $_POST = filter_input_array(INPUT_POST,FILTER_UNSAFE_RAW);
            $comment = new Comment([
                'author' => trim($_POST['pseudo']),
                'content' => trim($_POST['comment']),
                'articleId' => $_GET['id']]);

            /* Validation de l'auteur du commentaire */
            $pseudoValidation = "/^[a-zA-Z0-9]*$/";
            // Check si vide
            if(empty($comment->author())){
                $data['authorError'] = 'Veuillez entrez un pseudo';
            // S'assurer qu'il ne contient que des lettres et des chiffres
            }elseif(!preg_match($pseudoValidation, $comment->author())){
                $data['authorError'] = 'Le pseudo ne peut contenir que des lettres et des chiffres';
            }

            /* Validation du contenu du commentaire */
            if(empty($comment->content())){
                $data['commentError'] = 'Veuillez entrer votre commentaire';
            }

            /* Check si aucune erreur dans inputs */
            if(empty($data['authorError']) && empty($data['commentError'])){
                // Ajouter le commentaire
                if(!$this->addCommentDb($comment->articleId(), $comment->author(), $comment->content())){
                    die('Something went wrong while inserting comment in db');
                }
                return $data;
            }else{
                $data['hasError'] = 'true';
                return $data;
            }
    }
    
    public function addCommentDb($articleId, $author, $comment){
        $this->getBdd();
        $req = $this->_bdd->prepare('INSERT INTO comments (articleId, author, content, date) VALUES (?, ?, ?, ?)');
        if($req->execute([$articleId, $author, $comment, date("Y-m-d H:i:s")])){
            return true;
        }else{
            return false;
        }
    }

}