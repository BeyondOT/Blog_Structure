<?php
require_once './src/views/View.php';

class ControllerComments
{
    private $_commentsManager;
    private $_repliesManager;
    private $_view;

    public function __construct()
    {
        if(isset($url) && count($url) > 1){
            throw new \Exception("Page Introuvable", 1);       
        }elseif(isset($_GET['approve'])){
            $this->approve();
        }elseif(isset($_GET['delete'])){           
            $this->delete();
        }elseif($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['reply'])){
            $this->reply();
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

    private function reply(){
        $this->_repliesManager = new ReplyManager();
        if($this->_repliesManager->addReply()){
            header('location: comments');
        }else{
            die('something went wrong while adding reply to db');
        }
    }

    private function comments()
    {
        $this->_commentsManager = new CommentManager();
        $this->_repliesManager = new ReplyManager();

        $pendingComments = $this->_commentsManager->getPendingComments();
        $verifiedComments = $this->_commentsManager->getVerifiedComments();
        $replies = $this->_repliesManager->getAllReplies();
        
        $this->_view = new View('Comments');
        $this->_view->generate(array('pendingComments' => $pendingComments, 
                                     'verifiedComments' => $verifiedComments,
                                     'replies' => $replies));
    }
}
