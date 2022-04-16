<?php

class ControllerArticle
{
    private $_articleManager;
    private $_commentManager;
    private $_replyManager;
    private $_view;

    // TODO: Ajout,modfication et suppression d'un article
    public function __construct()
    {
        /* Initialisation de l'array qui contiendra les erreurs a afficher au user */

        $data =['authorError' => '',
                'commentError' => '',
                'replyError' => '',
                'hasError' => 'false'];

        if(isset($url) && count($url) > 1){
            throw new \Exception("Page Introuvable", 1);       
        }elseif($_GET['url'] == 'articles'){            
            $this->articles();
        }elseif($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['reply'])){
            $this->reply();
        }elseif($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['status'])){
            $this->comment($data);
        }else{
            $this->article($data);
        }
    }

    private function articles()
    {
        $this->_articleManager = new ArticleManager();
        $articles = $this->_articleManager->getArticles();
        
        $this->_view = new View('Accueil');
        $this->_view->generate(array('articles' => $articles));
    }
    
    private function article($data)
    {
        /* Initialisation des deux managers */
        $this->_articleManager = new ArticleManager();
        $this->_commentManager = new CommentManager();
        $this->_replyManager = new ReplyManager();
   
        $article = $this->_articleManager->getArticle($_GET['id']);
        $comments = $this->_commentManager->getCommentsByArticleId($_GET['id']);
        $replies = $this->_replyManager->getAllReplies();
    
        $this->_view = new View('Article');
        $this->_view->generate(array('article' => $article,
                                        'comments' => $comments,
                                        'data' =>  $data,
                                        'replies' => $replies));          
    }
    
    private function comment($data){
        $this->_commentManager = new CommentManager();
        $data = $this->_commentManager->addComment($data);
        // Si l'insertion c'est bien passé sans erreur 
        // Redirection vers la page de l'article
        if($data['hasError'] == 'false'){
            header("location: article&id=".$_GET['id']);
        //Sinon générer la vue avec les erreurs
        }else{
            $this->article($data);
        }
    }

    private function reply(){
        $this->_repliesManager = new ReplyManager();
        if($this->_repliesManager->addReply()){
            header("location: article&id=".$_GET['id']);
        }else{
            die('something went wrong while adding reply to db');
        }
    }

        

}