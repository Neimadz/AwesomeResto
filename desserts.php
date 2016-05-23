<?php 
require_once 'inc/connect.php';
require_once 'inc/header.php'; 
?>

<div class="wrapper-index">
	<h1 id="title-index" class="text-center">Tous les desserts de nos chefs</h1>
	<div id="wrapper-recettes" class="container">
		<div class="row">
				<br>
				<?php
					foreach(selectCategory('dessert') as $dessert) {
						echo '<div class="row">';
						echo '<div class="recette col-sm-4 text-center">';
						echo '<img class="img-list" src="'.$dessert['link'].'"><br><br>';
						echo '</div>';
						echo '<div class="recette col-sm-8">';
						echo '<h2><a href="read_recipe.php?id='.$dessert['id'].'">'.$dessert['title'].'</a></h2><br>';
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



            <div class="img_print">
		        <p><i class="fa fa-print" aria-hidden="true"></i> Print it</p>
		        <p><a href="https://facebook.com"><i class="fa fa-facebook" aria-hidden="true"></i> Share it</a></p>
		        <p><a href="https://fr.pinterest.com/"><i class="fa fa-pinterest-p" aria-hidden="true"></i>Pint it</a></p>
		    </div>