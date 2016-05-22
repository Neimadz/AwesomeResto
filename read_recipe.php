<?php

require_once 'inc/connect.php';

require_once 'inc/header.php';

/* On vérifie que l'ID de la recette existe et n'est pas vide
Si l'id n'est pas de type numérique, on force la valeur à 1
*/
if(isset($_GET['id']) && !empty($_GET['id'])){
	$idRecipe = $_GET['id']; 
	if(!is_numeric($idRecipe)){
		$idRecipe = 1;
	}
}

if(!empty($_GET)){
	if(isset($idRecipe)){
	// Prépare et execute la requète SQL pour récuperer notre recipe de manière dynamique
	$res = $db->prepare('SELECT * FROM recipes WHERE id = :idRecipe');
	$res->bindParam(':idRecipe', $idRecipe, PDO::PARAM_INT);
	$res->execute();

	// $recipe contient mon recipe extrait de la bdd
	$recipe = $res->fetch(PDO::FETCH_ASSOC);

	echo '<div class="imgOneRecipe">';
	echo '<br>';
	echo '<h2 class="readTitle">' .$recipe['title'] . '</h2>';
	echo '<br>';
	echo '<p class="readPublish">Publié le : '.$recipe['date_publish']; 
	echo '<br><br>';
	echo '<img class="" src="'.$recipe['link'].'">';
	echo '<br><br>';
	echo '<p class="readContent">' .$recipe['content'].'</p>';
	echo '<br>';
	echo '</div>';

	} else {
		echo 'Article introuvable !';
	}
}

require_once 'inc/footer.php';
