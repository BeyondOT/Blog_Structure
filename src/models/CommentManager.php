<?php

class CommentManager extends Model
{
    // methode qui recupere les articles dans la bdd

    public function getCommentsById($id)
    {
        //  TODO: afficher seuls les commentaires verifiés
        return $this->queryObjects('SELECT * FROM comments WHERE articleId = ?', [$id], 'Comment');
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