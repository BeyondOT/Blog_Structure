<?php

class ArticleManager extends Model
{
    // methode qui recupere les articles dans la bdd
    public function getArticles(){
        return $this->getAll('articles', 'Article');
    }
}