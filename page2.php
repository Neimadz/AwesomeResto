<?php 
require_once 'inc/connect.php';
require_once 'inc/header.php'; 
?>

<div class="wrapper-index">
	<h1 id="title-index" class="text-center">Toutes nos recettes de chef</h1>
	<div id="wrapper-recettes" class="container">
		<div class="row">
			<div class=" col-xs-12 col-sm-4 text-center">
				<h2 class="titre-p2">Nos entrées</h2>
				<br>
				<?php
					foreach(selectCategory('entrance') as $entree) {
						echo '<div class="page2-recette">';
							echo '<br>';
							echo '<p> <a class="btnrecipe" href="read_recipe.php?id='.$entree['id'].'"> <h2>'.cutString($entree['title'],0, 25, '...').'</h2> <br> </a>'; 
							echo '<img class="index-recipe-img" src="'.$entree['link'].'"><br><br>';
							echo '<p>'.cutString($entree['content'],0, 100, '...').'</p>';
							echo '<br>';
						echo '</div>';
					}
				?>
			</div>
			<div class="page2-recette col-xs-12 col-sm-4 text-center">
				<h2 class="titre-p2">Nos plats</h2>
				<br>
				<?php
					foreach (selectCategory('dish') as $plat) {
						echo '<div class="page2-recette">';
							echo '<br>';
							echo '<p> <a class="btnrecipe" href="read_recipe.php?id='.$plat['id'].'"> <h2>'.cutString($plat['title'],0, 25, '...').'</h2> <br> </a>';
							echo '<img class="index-recipe-img" src="'.$plat['link'].'"><br><br>';
							echo '<p>'.cutString($plat['content'],0, 100, '...').'</p>';
						echo '</div>';
					}
				?>
			</div>
			<div class="page2-recette col-xs-12 col-sm-4 text-center">
				<h2 class="titre-p2">Nos desserts</h2>
				<br>
				<?php
					foreach (selectCategory('dessert') as $dessert) {
						echo '<div class="page2-recette">';
							echo '<br>';
							echo '<p> <a class="btnrecipe" href="read_recipe.php?id='.$dessert['id'].'"> <h2>'.cutString($dessert['title'],0, 25, '...').'</h2> <br> </a>';
							echo '<img class="index-recipe-img" src="'.$dessert['link'].'"><br><br>';
							echo '<p>'.cutString($dessert['content'],0, 100, '...').'</p>';
						echo '</div>';
					}
				?>
			</div>
		</div>
	</div>
</div>
<?php

include_once 'inc/footer.php';
?>

