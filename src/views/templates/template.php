<!doctype html>
<html lang="fr">
<head>
<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= $t ?></title>
	<link rel="stylesheet" href="css/styles.css">
  <link rel="icon" href="img/favicon.jpg">
</head>
<body>
  <div class="l-main main">
  <!-- HEADER ---------------------------------------- :  -->
    <?php require_once './src/views/includes/header.php'?>

	<!-- MAIN : -----------------------------------------:   -->
	<div class="content-container">

		<?= $content ?>

	</div>
            
    <footer class="footer" role="contentinfo">
        2022. This is a footer
    </footer>
  </div>

  <script src="https://kit.fontawesome.com/5107ed0a12.js" crossorigin="anonymous"></script>
  <script type="module" src="../../../Projet/js/script.js"></script> 

</body>

</html>

