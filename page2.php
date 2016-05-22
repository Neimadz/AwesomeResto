<?php 
require_once 'inc/connect.php';
require_once 'inc/header.php'; 
?>

<div class="wrapper-index">
	<h1 id="title-index" class="text-center">Toutes nos recettes de chef</h1>
	<div id="wrapper-recettes" class="container">
		<div class="row">
			<div class="recette col-sm-4 text-center">
				<h2 class="titre-p2">Nos entrées</h2>
				<br>
				<?php
					foreach(selectCategory('entrance') as $entree) {
						echo '<br>';
						echo 'ENTRÉE';
						echo '<h2>'.cutString($entree['title'],0, 30, '...').'</h2><br>';
						echo '<img class="img" src="'.$entree['link'].'"><br><br>';
						echo '<p>'.cutString($entree['content'],0, 100, '...').'</p><hr>';
						echo '<br>';
						// En récupérant l'id de l'article, je peux le passer en GET afin d'avoir un seul et même fichier pour lire chaque article individuellement 
						echo '<p> <a class="btnrecipe" href="read_recipe.php?id='.$entree['id'].'"> READ THE RECIPE </a>';
					}
				?>
			</div>
			<div class="recette col-sm-4 text-center">
				<h2 class="titre-p2">Nos plats</h2>
				<br>
				<?php
					foreach (selectCategory('dish') as $plat) {
						echo '<br>';
						echo 'PLATS';
						echo '<h2>'.cutString($plat['title'],0, 30, '...').'</h2><br>';
						echo '<img class="img" src="'.$plat['link'].'"><br><br>';
						echo '<p>'.cutString($plat['content'],0, 100, '...').'</p><hr>';
						echo '<p> <a class="btnrecipe" href="read_recipe.php?id='.$plat['id'].'"> READ THE RECIPE </a>';
					}
				?>
			</div>
			<div class="recette col-sm-4 text-center">
				<h2 class="titre-p2">Nos desserts</h2>
				<br>
				<?php
					foreach (selectCategory('dessert') as $dessert) {
						echo '<br>';
						echo 'DESSERTS';
						echo '<h2>'.cutString($dessert['title'],0, 30, '...').'</h2><br>';
						echo '<img class="img" src="'.$dessert['link'].'"><br><br>';
						echo '<p>'.cutString($dessert['content'],0, 100, '...').'</p><hr>';
						echo '<p> <a class="btnrecipe" href="read_recipe.php?id='.$dessert['id'].'"> READ THE RECIPE </a>';
					}
				?>
			</div>
		</div>
	</div>
</div>
<?php

include_once 'inc/footer.php';
?>

