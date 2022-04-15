<?php
require_once './src/views/View.php';

class ControllerArticle
{
    private $_articleManager;
    private $_commentManager;
    private $_replyManager;
    private $_view;

    // TODO: Clean up en factorisant les fonctions
    // TODO: Ajout,modfication et suppression d'un article
    public function __construct()
    { 
        if(isset($url) && count($url) > 1){
            throw new \Exception("Page Introuvable", 1);       
        }elseif($_GET['url'] == 'articles'){            
            $this->articles();
        }elseif($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['reply'])){
            $this->reply();
        }else{
            $this->article();
        }
    }

    private function articles()
    {
        $this->_articleManager = new ArticleManager();
        $articles = $this->_articleManager->getArticles();
        
        $this->_view = new View('Accueil');
        $this->_view->generate(array('articles' => $articles));
    }
    
    private function article()
    {
        /* Initialisation des deux managers */
        $this->_articleManager = new ArticleManager();
        $this->_commentManager = new CommentManager();
        $this->_replyManager = new ReplyManager();

        /* Initialisation de l'array qui contiendra les erreurs a afficher au user */
        $data= ['authorError' => '',
                'commentError' => '',
                'replyError' => ''];
            
        /* Check s'il y'a un ajout de commentaire */
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['status'])){
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
                if(!$this->_commentManager->addCommentDb($comment->articleId(), $comment->author(), $comment->content())){
                    die('something went wrong');
                }
            }
        }     
        
        if(isset($_GET['id'])){

            $article = $this->_articleManager->getArticle($_GET['id']);
            $comments = $this->_commentManager->getCommentsByArticleId($_GET['id']);
            $replies = $this->_replyManager->getAllReplies();
        
            $this->_view = new View('Article');
            $this->_view->generate(array('article' => $article,
                                         'comments' => $comments,
                                         'data' =>  $data,
                                         'replies' => $replies));
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