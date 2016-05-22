<?php 
require_once 'inc/connect.php';
require_once 'inc/header.php'; 
?>

<div class="wrapper-index">
	<h1 id="title-index" class="text-center">Toutes les plats de nos chefs</h1>
	<div id="wrapper-recettes" class="container">
				<br>
				<?php
					foreach(selectCategory('dish') as $plats) {
						echo '<div class="row">';
							echo '<div class="recette col-sm-4 text-center">';
								echo '<img class="img-list" src="'.$plats['link'].'"><br><br>';
							echo '</div>';
							echo '<div class="recette col-sm-8">';
								echo '<h2><a href="">'.$plats['title'].'</a></h2><br>';
								echo '<p>'.$plats['content'].'</p>';
							echo '</div><br>';
							echo '<p> <a class="btnrecipe" href="read_recipe.php?id='.$plats['id'].'"> READ THE RECIPE </a>';
						echo '</div>';
					}
				?>
	</div>
</div>
<?php

include_once 'inc/footer.php';
?>
