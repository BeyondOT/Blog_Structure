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