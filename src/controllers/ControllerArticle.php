<?php
require_once './src/views/View.php';

class ControllerArticle
{
    private $_articleManager;
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
        if(isset($_GET['id'])){
            $this->_articleManager = new ArticleManager();
            $article = $this->_articleManager->getArticle($_GET['id']);
            
            
            $this->_view = new View('Article');
            $this->_view->generateArticle(array('article' => $article));
        }      
    }
        

}