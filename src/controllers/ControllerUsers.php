<?php
require_once './src/views/View.php';

class ControllerUsers
{
    private $_user;
    private $_userManager;
    private $_view;

    public function __construct($url)
    { 
        if(isset($url) && count($url) > 2){
            throw new \Exception("Page Introuvable", 1);       
        }else{
            // Voir quelle page l'utilisateur a demandé
            // Appeler la fonction en fonction
            if($_GET['auth'] == 'register'){
                $this->register();
            }elseif($_GET['auth'] == 'logout'){
                $this->logout(); 
            }else{
                $this->login(); 
            }
        }
    }
    
    private function login()
    {   
        $this->_userManager = new UserManager();
        $data = [
            'usernameError' => '',
            'passwordError' => ''
        ]; 
        
        /* Si une requete POST a été envoyé => traiter les données */
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Filtration des données
            $_POST = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);

            // Affectation en trimant les données
            $this->_user = new User(
                ['username' => trim($_POST['username']),
                 'password' => trim($_POST['password'])]);

            /* Validation de l'username */
            // Checker si non-vide :
            if(empty($this->_user->username())){
                $data['usernameError'] = 'Please enter a username';
            }

            /* Validation du mot de passe */
            // Checker si non vide :
            if(empty($this->_user->password())){
                $data['passwordError'] = 'Please enter a password';
            }

            // Check s'il n'y a aucune erreur
            // [x]: completer cette fonction pour le login
            if(empty($data['usernameError']) && empty($data['passwordError'])){
                // Essayer de se connecter
                $loggedIn = $this->_userManager->login($this->_user->username(), $this->_user->password());

                // Si on réussi à se connecter créer une session
                if($loggedIn) {
                    $this->_user = $loggedIn;
                    $this->createUserSession();

                // Sinon il y'a eu un problème lors de la connection
                }else{
                    $data['passwordError'] = 'Password or username is incorrect. Please try again.';
                }
            }

        }
        // Genere la vue et l'imprime
        $this->_view = new View('Login'); 
        $this->_view->generate(array('data' => $data));
    }

    // TODO: Changer la langue des commentaires et des messages pour l'utilisateur
    private function register()
    {   
        $this->_userManager = new UserManager();
        $data = [
            'usernameError' => '',
            'emailError' => '',
            'passwordError' => '',
            'confirmPasswordError' => ''
        ];

        /* Checker si requete POST */
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);
            
            $this->_user = new User(
                ['username' => trim($_POST['username']),
                 'email' => trim($_POST['email']),
                 'password' => trim($_POST['password'])]);
                 
            $confirmPassword = trim($_POST['confirmPassword']);
            
            // Variables de validation
            $nameValidation = "/^[a-zA-Z0-9]*$/";
            $passwordValidation = "/^(.{0,7}|[^a-z]*|[^\d]*)$/i";

            /* Validation de l'username */
            // Check si vide
            if(empty($this->_user->username())){
                $data['usernameError'] = 'Please enter username.';
            // Check s'il correspond au variables de validation 
            } elseif(!preg_match($nameValidation, $this->_user->username())){
                $data['usernameError'] = 'Name can only containe letters and numbers';
            }

            /* Validation de l'e-mail */
            // Check si vide
            if(empty($this->_user->email())){
                $data['emailError'] = 'Please enter email.';
            // Check si correspond au variables de validation
            } elseif(!filter_var($this->_user->email(), FILTER_VALIDATE_EMAIL)){
                $data['emailError'] = 'Invalid e-mail format. Please try again.';
            // Check si l'email et l'username n'existent pas déja dans la bdd
            } else {
                if(!empty($this->_userManager->getUserByEmail($this->_user->email()))) {
                    $data['emailError'] = 'Cet e-mail est déja utilisé';
                }
                if(!empty($this->_userManager->getUserByUsername($this->_user->username()))){
                    $data['usernameError'] = 'Cet username est déja utilisé';
                }
            }

            /* Validation du mot de passe */
            // Check si vide
            if(empty($this->_user->password())){
                $data['passwordError'] = 'Please enter a password.';
            // Check s'il contient au moins 8 charactères
            } elseif(strlen($this->_user->password()) < 7){
                $data['passwordError'] = 'Password must contain at least 8 charachters';
            // Check si'il contient au moins un numéro
            }elseif(preg_match($passwordValidation, $this->_user->password())){
                $data['passwordError'] = 'Password must have at least one numeric value';
            }

            /* Validation de la confirmation du mot de passe */
            // Check si vide
            if(empty($confirmPassword)){
                $data['confirmPasswordError'] = 'Please enter a password.';
            // Check si correspond au mdp
            } else{
                if($this->_user->password() != $confirmPassword){
                    $data['confirmPasswordError'] = "The passwords don't match.";
                }
            }

            // S'assurer que toutes les erreurs sonts vides
            if(empty($data['usernameError']) && empty($data['emailError']) && empty($data['passwordError']) && empty($data['confirmPasswordError'])){
                //Hashage du mot de passe
                $this->_user->setPassword(password_hash($this->_user->password(), PASSWORD_DEFAULT));

                // Register user
                if($this->_userManager->register($this->_user->username(), $this->_user->email(), $this->_user->password())){
                    header('location: accueil');
                }else{
                    die('Something went wrong');
                }
            }
        } 
        $this->_view = new View('Register'); 
        $this->_view->generate(array('data' => $data));
    }

    public function createUserSession() {
        $_SESSION['user_id'] = $this->_user->id();
        $_SESSION['username'] = $this->_user->username();
        $_SESSION['email'] = $this->_user->email();
        header('location: accueil');
    }
    
    public function logout(){
        unset($_SESSION['user_id']);
        unset($_SESSION['username']);
        unset($_SESSION['email']);
        header('location: accueil');
    }
        

}