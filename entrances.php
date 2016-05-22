<?php 
require_once 'inc/connect.php';
require_once 'inc/header.php'; 
?>

<div class="wrapper-index">
	<h1 id="title-index" class="text-center">Toutes les entrées de nos chefs</h1>
	<div id="wrapper-recettes" class="container">
		<div class="row">
				<br>
				<?php
					foreach(selectCategory('entrance') as $entree) {
						echo '<div class="row">';
							echo '<div class="recette col-sm-6 text-center">';
								echo '<img class="img-list" src="'.$entree['link'].'"><br><br>';
							echo '</div>';
							echo '<div class="recette col-sm-6">';
								echo '<h2><a href="">'.$entree['title'].'</a></h2><br>';
								echo '<p>'.$entree['content'].'</p>';
							echo '</div><br>';
						echo '</div>';
					}
				?>
		</div>
	</div>
</div>
<?php

include_once 'inc/footer.php';
?>

