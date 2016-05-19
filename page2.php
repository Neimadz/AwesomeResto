<?php 
require_once 'inc/connect.php';
include_once 'inc/functions.php';

function selectCategory($role){
	global $db; // Va chercher la variable $db qui se trouve hors de la fonction

	// Prépare et execute la requète SQL
	$debut = $db->prepare('SELECT * FROM recipes WHERE role = :assoc ORDER BY date_publish ASC');
	$debut->bindValue(':assoc', $role);
	$debut->execute();

	// Retourne tous les roles de la table "recipes" indiqué dans la fonction sous forme de array()
	return $debut->fetchAll(PDO::FETCH_ASSOC);
}

require_once 'inc/header.php'; 
?>

<div id="wrapper-index">
	<h1 id="title-index" class="text-center">Toutes nos recettes de chef</h1>
	<div id="wrapper-recettes" class="container">
		<div class="recette col-sm-4 text-center">
			<h2 class="titre-p2">Nos entrées</h2>
			<br>
			<?php
				foreach(selectCategory('entrance') as $entree) {
					echo '<h2>'.$entree['title'].'</h2><br>';
					echo '<img id="img" src="'.$entree['link'].'"><br><br>';
					echo '<p>'.$entree['content'].'</p><hr>';
				}
			?>
		</div>
		<div class="recette col-sm-4 text-center">
			<h2 class="titre-p2">Nos plats</h2>
			<br>
			<?php
				foreach (selectCategory('dish') as $plat) {
					echo '<h2>'.$plat['title'].'</h2><br>';
					echo '<img id="img" src="'.$plat['link'].'"><br><br>';
					echo '<p>'.$plat['content'].'</p><hr>';
				}
			?>
		</div>
		<div class="recette col-sm-4 text-center">
			<h2 class="titre-p2">Nos desserts</h2>
			<br>
			<?php
				foreach (selectCategory('dessert') as $dessert) {
					echo '<h2>'.$dessert['title'].'</h2><br>';
					echo '<img id="img" src="'.$dessert['link'].'"><br><br>';
					echo '<p>'.$dessert['content'].'</p><hr>';
				}
			?>
		</div>
	</div>
</div>
<?php

include_once 'inc/footer.php';
?>

