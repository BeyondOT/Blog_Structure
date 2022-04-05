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
    <header class="header" role="banner">
        <h1 class="main-home"><a href="accueil">My Blog</a></h1>
    </header>
    <nav class="navigation">
        <ul class="navigation-list">
        <li class="navigation-item"><a class="navigation-link" href="#">Home</a></li>
        <li class="navigation-item"><a class="navigation-link" href="#">Melfor</a></li>
        <li class="navigation-item"><a class="navigation-link" href="#">Carola</a></li>
        <li class="navigation-item"><a class="navigation-link" href="#">Kuglof</a></li>
        <li class="navigation-item"><a class="navigation-link" href="#">Wurscht</a></li>
        </ul>
    </nav>

    <div class="sidebar">

    </div>

	
	<div class="content-container">

		<?= $content ?>

	</div>

             
    <footer class="footer" role="contentinfo">
        2022. This is a footer
    </footer>
	<script src="../../js/script.js"></script>
  </div>
  
</body>

</html>

