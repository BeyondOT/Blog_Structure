<?php 
  require_once('helpers/session_helper.php');
  require_once('src/libraries/Router.php');
  require_once 'src/libraries/Model.php';
  require_once 'src/libraries/View.php';
  

  $router = new Router();
  
  $router->routeReq();
  
