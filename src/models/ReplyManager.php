<?php
class ReplyManager extends Model{

    public function getAllReplies()
    {
        return $this->queryObjectsNoOptions('SELECT * FROM replies ORDER BY date asc', 'Reply');
    }

    public function addReply(){
        $_POST = filter_input_array(INPUT_POST,FILTER_UNSAFE_RAW);
            $reply = new Reply([
                'author' => $_SESSION['username'],
                'content' => trim($_POST['reply']),
                'commentId' => $_GET['reply']
            ]);
    
            if($this->addReplyDb($reply->commentId(), $reply->author(), $reply->content())){
                return true;
            }else{
                die('Something went wrong while adding reply to the data base');
            }
    }

    public function addReplyDb($commentId, $author, $content){
        $this->getBdd();
        $req = $this->_bdd->prepare('INSERT INTO replies (commentId, author, content, date) VALUES (?, ?, ?, ?)');
        if($req->execute([$commentId, $author, $content, date("Y-m-d H:i:s")])){
            return true;
        }else{
            return false;
        }
    }


}