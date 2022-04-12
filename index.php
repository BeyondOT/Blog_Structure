<?php 
  require_once('helpers/session_helper.php');
  require_once('src/controllers/Router.php');
  

  $router = new Router();
  
  $router->routeReq();
  
