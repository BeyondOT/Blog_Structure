<!doctype html>
<html lang="fr">
<head>
<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= $t ?></title>
	<link rel="stylesheet" href="css/styles.css">
</head>
<body>
  <div class="l-main main">

  <!-- HEADER ---------------------------------------- :  -->
    <header class="header" role="banner">  
        <nav class="navigation">
            <label class="logo">My Blog</label>
            <ul class="navigation-list">
                <li class="navigation-item"><a class="navigation-link" href="accueil">Home</a></li>
                <li class="navigation-item"><a class="navigation-link" href="#">About</a></li>
                <li class="navigation-item"><a class="navigation-link" href="#">Articles</a></li>
                <li class="navigation-item"><a class="navigation-link" href="#">Login</a></li>
            </ul>
            <div class="burger">
                <div class="line1"></div>
                <div class="line2"></div>
                <div class="line3"></div>
            </div>
        </nav>
    </header>

    <div class="sidebar_left"></div>

    <div class="sidebar_right"></div>


	
	<div class="content-container">

		<?= $content ?>

	</div>

             
    <footer class="footer" role="contentinfo">
        2022. This is a footer
    </footer>
  </div>

  <script src="../../../Projet/js/script.js"></script> 

</body>

</html>

