<?php
require_once './src/views/View.php';

class Router
{
    private $_ctrl;
    private $_view;
    
    public function routeReq()
    {
        try 
        {
            // Chargement automatique des classes du dossier models
            spl_autoload_register(function($class){
                require_once('./src/models/'.$class.'.php');
            });
            // On crée une variable url
            $url = '';
  
            //On va détéerminer le controleur en fct de $url

            if(isset($_GET['url'])){
                
                // On décompose l'url et on lui applique un fitre
                $url = explode('/', filter_var($_GET['url'], FILTER_SANITIZE_URL));
  
                // On recupere le premier param de l'url et on met sa prem lettre en maj
                $controller = ucfirst(strtolower($url[0]));
                

                $controllerClass = "Controller".$controller;

                // On retrouve le chemin du controller voulu
                $controllerFile = "./src/controllers/".$controllerClass.".php";
                

                if (file_exists($controllerFile))
                {   
                    //On lance la class en question avec tout les param url
                    require_once($controllerFile);
                    $this->_ctrl = new $controllerClass($url);
                }else{
                    
                    throw new \Exception("Page introuvable",1); 
                }
                
            }else{
                require_once('./src/controllers/ControllerAccueil.php');
                $this->_ctrl = new ControllerAccueil($url);
            }
            

        } 
        catch (\Exception $e)
        {
            $errorMsg = $e->getMessage();
            $this->_view = new View('Error');
            $this->_view->generate(array('errorMsg' => $errorMsg));
        }
    }
}

