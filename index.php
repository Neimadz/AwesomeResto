<?php
require_once 'inc/connect.php';

// Prépare et execute la requète SQL pour récupérer nos entrées
$entrance = $db->prepare('SELECT * FROM recipes WHERE role = "entrance" ORDER BY date_publish DESC LIMIT 1');
$entrance->execute();
// Retourne toutes les entrées de la table "recipes" sous forme de array()
$entrees = $entrance->fetchAll(PDO::FETCH_ASSOC);

// Prépare et execute la requète SQL pour récupérer nos plats
$dish = $db->prepare('SELECT * FROM recipes WHERE role = "dish" ORDER BY date_publish DESC LIMIT 1');
$dish->execute();
// Retourne toutes les plats de la table "recipes" sous forme de array()
$plats = $dish->fetchALL(PDO::FETCH_ASSOC);

// Prépare et execute la requète SQL pour récupérer nos desserts
$desserts = $db->prepare('SELECT * FROM recipes WHERE role = "dish" ORDER BY date_publish DESC LIMIT 1');
$desserts->execute();
// Retourne toutes les desserts de la table "recipes" sous forme de array()
$sucreries = $desserts->fetchAll(PDO::FETCH_ASSOC);

include_once 'inc/header.php';
?>

<div id="wrapper-index"> 
	<h1 id="title-index">Les recettes des chefs</h1>
	<div id="wrapper-recettes">
		<div class="recette">
			<a href="#entree">Liste de nos entrées</a>
			<br>
			<?php
				foreach ($entrees as $entree) {
					echo '<img class="img-accueil" src="'.$entree['link'].'">'; // Lien image entrée
					echo '<br>';
					echo $entree['title']; // Nom de l'entrée
				}
			?>
		</div>
		<div class="recette">
			<a href="#plats">Liste de nos plats</a>
			<br>
			<?php
				foreach ($plats as $plat) {
					echo '<img class="img-accueil" src="'.$plat['link'].'">'; // Lien image entrée
					echo '<br>';
					echo $plat['title']; // Nom de l'entrée
				}
			?>
		</div>
		<div class="recette">
			<a href="#desserts">Liste de nos desserts</a>
			<br>
			<?php
				foreach ($sucreries as $dessert) {
					echo '<img class="img-accueil" src="'.$dessert['link'].'">'; // Lien image entrée
					echo '<br>';
					echo $dessert['title']; // Nom de l'entrée
				}
			?>
		</div>
	</div>
	<div id="bouton-recettes" class="text-center">
		<a class="btn btn-default" href="#" role="button" href="">Découvrir toutes <br> les recettes des chefs</a>
	</div>
</div>
<?php
	include_once 'inc/footer.php';
?>