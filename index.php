<?php
require_once 'inc/connect.php';
include_once 'inc/header.php';
?>

<section class="wrapper-index">
	<h1 id="title-index" class="text-center">Les recettes des chefs</h1>
	<div class="container">
		<div class="row">

			<div class="index-recipe col-xs-12 col-sm-4 text-center">
				<div class="thumbnail">

					<?php
						foreach(selectCategoryIndex('entrance') as $ent) {
							showRecipe($ent);
						}
					?>
					<p>
						<a class="index-recipe-link-all" href="entrances.php">Voir toutes nos entrées <span class="glyphicon glyphicon-arrow-right"></span></a>
					</p>
				</div>
			</div>

			<div class="index-recipe col-xs-12 col-sm-4 text-center">
				<div class="thumbnail">
					<?php
						foreach (selectCategoryIndex('dish') as $plat) {
							showRecipe($plat);
						}
					?>
					<p>
						<a class="index-recipe-link-all" href="dishs.php">Voir tous nos plats <span class="glyphicon glyphicon-arrow-right"></span></a>
					</p>
				</div>
			</div>

			<div class="index-recipe col-xs-12 col-sm-4 text-center">
				<div class="thumbnail">
					<?php
						foreach (selectCategoryIndex('dessert') as $dessert) {
							showRecipe($dessert);
						}
					?>
					<p>
						<a class="index-recipe-link-all" href="desserts.php">Voir tous nos desserts <span class="glyphicon glyphicon-arrow-right"></span></a>
					</p>
				</div>
			</div>
		</div>
	</div>
</section>

<section id="index-our-chef">
	<a class="btn btn-default see-all-recipes-index" href="page2.php" role="button" href="#">Découvrir toutes <br> les recettes des chefs</a>
</section>

<?php
	include_once 'inc/footer.php';
?>
