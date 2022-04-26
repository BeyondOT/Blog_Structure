<header class="header" role="banner">  
    <?php 
    if(isLoggedIn()){
        require_once './src/views/includes/navigationLoggedIn.php';     
    }else{
        require_once './src/views/includes/navigation.php';
    } ?>

    <?php 
    if(getView() == 'accueil'):?>
    <div class="container">
        <img class="main-image" src="img/main_picture.jpg" alt="Italian Trulli">
        <h1 class="centered home-title">Bienvenue sur mon Blog ! </h1>
    </div>


    <?php endif;?>
</header>