<?php

class ArticleManager extends Model
{
    // methode qui recupere les articles dans la bdd
    public function getArticles()
    {
        return $this->getAll('articles', 'Article');
    }

    public function getArticle($id)
    {
        return $this->getOne('articles', 'Article', $id);
    }
}