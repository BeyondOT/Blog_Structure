<?php

    function getView(){
        if(isset($_GET['url'])){
            return $_GET['url'];
        }else{
            return false;
        }
    }
    // Start la session
    session_start();

    function isLoggedIn(){
        if(isset($_SESSION['user_id'])){
            return true;
        }else {
            return false;
        }
    }