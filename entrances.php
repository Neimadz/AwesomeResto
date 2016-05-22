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
						showRecipe($entree);
					}
				?>
		</div>
	</div>
</div>
<?php

include_once 'inc/footer.php';
?>

