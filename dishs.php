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
					foreach(selectCategory('dish') as $entree) {
						echo '<div class="recette col-sm-4 text-center">';
							echo '<img class="img-list" src="'.$entree['link'].'"><br><br>';
							echo '<h2>'.cutString($entree['title'],0, 30, '...').'</h2><br>';
							echo '<p>'.cutString($entree['content'],0, 100, '...').'</p><hr>';
						echo '</div>';
					}
				?>
		</div>
	</div>
</div>
<?php

include_once 'inc/footer.php';
?>
