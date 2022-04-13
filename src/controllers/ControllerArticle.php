<?php
require_once './src/views/View.php';

class ControllerArticle
{
    private $_articleManager;
    private $_commentManager;
    private $_view;

    public function __construct()
    { 
        if(isset($url) && count($url) > 1){
            throw new \Exception("Page Introuvable", 1);       
        }else{            
            $this->article();
        }
    }
    private function article()
    {
        /* Initialisation des deux managers */
        $this->_articleManager = new ArticleManager();
        $this->_commentManager = new CommentManager();

        /* Initialisation de l'array qui contiendra les erreurs a afficher au user */
        $data= ['authorError' => '',
                'commentError' => ''];
            
        /* Check s'il y'a un ajout de commentaire */
        // [ ]: Check aussi le  status du $_GET['status']
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
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
            $comments = $this->_commentManager->getCommentsById($_GET['id']);
        
            $this->_view = new View('Article');
            $this->_view->generate(array('article' => $article, 'comments' => $comments, 'data' =>  $data));
        }      
    }
        

}