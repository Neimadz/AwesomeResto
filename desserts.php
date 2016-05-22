<?php 
require_once 'inc/connect.php';
require_once 'inc/header.php'; 
?>

<div class="wrapper-index">
	<h1 id="title-index" class="text-center">Toutes les desserts de nos chefs</h1>
	<div id="wrapper-recettes" class="container">
		<div class="row">
				<br>
				<?php
					foreach(selectCategory('dessert') as $dessert) {
						echo '<div class="row">';
							echo '<div class="recette col-sm-6 text-center">';
								echo '<img class="img-list" src="'.$dessert['link'].'"><br><br>';
							echo '</div>';
							echo '<div class="recette col-sm-6">';
								echo '<h2><a href="">'.$dessert['title'].'</a></h2><br>';
								echo '<p>'.$dessert['content'].'</p>';
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
