<?php
require_once './src/views/View.php';

class ControllerComments
{
    private $_commentsManager;
    private $_view;

    public function __construct()
    {
        if(isset($url) && count($url) > 1){
            throw new \Exception("Page Introuvable", 1);       
        }elseif(isset($_GET['approve'])){
            $this->approve();
        }elseif(isset($_GET['delete'])){           
            $this->delete();
        }else{
            $this->comments();
        }
    }

    private function approve()
    {
        $this->_commentsManager = new CommentManager();
        if($this->_commentsManager->approveComment($_GET['approve'])){
            header('location: comments');
        }else{
            die('Something went wrong');
        }
    }

    private function delete()
    {
        $this->_commentsManager = new CommentManager();
        if($this->_commentsManager->deleteComment($_GET['delete'])){
            header('location: comments');
        }else{
            die('Something went wrong');
        }
    }

    private function comments()
    {
        $this->_commentsManager = new CommentManager();
        $pendingComments = $this->_commentsManager->getPendingComments();
        $verifiedComments = $this->_commentsManager->getVerifiedComments();
        
        $this->_view = new View('Comments');
        $this->_view->generate(array('pendingComments' => $pendingComments, 
                                     'verifiedComments' => $verifiedComments));
    }
}
