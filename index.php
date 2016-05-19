<?php
require_once 'inc/connect.php';

// Déclaration variable
function selectCategory($role){
	global $db; // Va chercher la variable $db qui se trouve hors de la fonction

	// Prépare et execute la requète SQL
	$debut = $db->prepare('SELECT * FROM recipes WHERE role = :assoc ORDER BY date_publish DESC LIMIT 1');
	$debut->bindValue(':assoc', $role);
	$debut->execute();

	// Retourne tous les roles de la table "recipes" indiqué dans la fonction sous forme de array()
	return $debut->fetchAll(PDO::FETCH_ASSOC);
}

include_once 'inc/header.php';
?>

<div id="wrapper-index"> 
	<h1 id="title-index" class="text-center">Les recettes des chefs</h1>
	<div id="wrapper-recettes" class="container">
		<div class="recette col-sm-4 text-center">
			<a class="link-index" href="#entree">Liste de nos entrées</a>
			<br>
			<?php
				foreach(selectCategory('entrance') as $entree) {
					echo '<img class="img-accueil" src="'.$entree['link'].'">'; // Lien image entrée
					echo '<br>';
					echo '<a class="link-index" href="#">'.$entree['title']."</a>"; // Nom de l'entrée
				}
			?>
		</div>
		<div class="recette col-sm-4 text-center">
			<a class="link-index" href="#plats">Liste de nos plats</a>
			<br>
			<?php
				foreach (selectCategory('dish') as $plat) {
					echo '<img class="img-accueil" src="'.$plat['link'].'">'; // Lien image entrée
					echo '<br>';
					echo '<a class="link-index" href="#">'.$plat['title']."</a>"; // Nom de l'entrée
				}
			?>
		</div>
		<div class="recette col-sm-4 text-center">
			<a class="link-index" href="#desserts">Liste de nos desserts</a>
			<br>
			<?php
				foreach (selectCategory('dessert') as $dessert) {
					echo '<img class="img-accueil" src="'.$dessert['link'].'">'; // Lien image entrée
					echo '<br>';
					echo '<a class="link-index" href="#">'.$dessert['title']."</a>"; // Nom de l'entrée
				}
			?>
		</div>
	</div>
	<div id="bouton-recettes" class="text-center">
		<a class="btn btn-default btn-recettes" href="page2.php" role="button" href="">Découvrir toutes <br> les recettes des chefs</a>
	</div>
</div>
<?php
	include_once 'inc/footer.php';
?>