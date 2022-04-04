<?php

class View
{
    private $_file;
    private $_t;

    public function __construct($action)
    {
        $this->_file = './src/views/view'.$action.'.php';
    }

    // Genere et affiche la vue 
    public function generate($data)
    {
        // Partie spécifique de la vue
        $content = $this->generateFile($this->_file, $data);

        // Template (contient les elements communs)
        $view = $this->generateFile('./src/views/template.php', array('t' => $this->_t, 'content' => $content));
        echo $view;
    }

    // Generee un fichier vue et renvoie le resultat produit
    private function generateFile($file, $data)
    {
        if(file_exists($file))
        {
            extract($data);

            ob_start();

            //Inclut le fichier vue
            require $file;

            return ob_get_clean();

        }else{
            throw new \Exception('Fichier '.$file.' introuvable', 1);
        }

    }
}