<?php 
require_once 'inc/connect.php';
include_once 'inc/functions.php';

require_once 'inc/header.php'; 
?>

<div id="wrapper-index">
	<h1 id="title-index" class="text-center">Toutes nos recettes de chef</h1>
	<div id="wrapper-recettes" class="container">
		<div class="recette col-sm-4 text-center">
			<h2 class="titre-p2">Nos entrées</h2>
			<br>
			<?php
				foreach(selectCategory('entrance') as $entree) {
					echo '<h2>'.cutString($entree['title'],0, 30, '...').'</h2><br>';
					echo '<img id="img" src="'.$entree['link'].'"><br><br>';
					echo '<p>'.cutString($entree['content'],0, 100, '...').'</p><hr>';
				}
			?>
		</div>
		<div class="recette col-sm-4 text-center">
			<h2 class="titre-p2">Nos plats</h2>
			<br>
			<?php
				foreach (selectCategory('dish') as $plat) {
					echo '<h2>'.cutString($plat['title'],0, 30, '...').'</h2><br>';
					echo '<img id="img" src="'.$plat['link'].'"><br><br>';
					echo '<p>'.cutString($plat['content'],0, 100, '...').'</p><hr>';
				}
			?>
		</div>
		<div class="recette col-sm-4 text-center">
			<h2 class="titre-p2">Nos desserts</h2>
			<br>
			<?php
				foreach (selectCategory('dessert') as $dessert) {
					echo '<h2>'.cutString($dessert['title'],0, 30, '...').'</h2><br>';
					echo '<img id="img" src="'.$dessert['link'].'"><br><br>';
					echo '<p>'.cutString($dessert['content'],0, 100, '...').'</p><hr>';
				}
			?>
		</div>
	</div>
</div>
<?php

include_once 'inc/footer.php';
?>

