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
	$res = $db->prepare('SELECT * FROM recipe WHERE id = :idRecipe');
	$res->bindParam(':idRecipe', $idRecipe, PDO::PARAM_INT);
	$res->execute();

	// $recipe contient mon recipe extrait de la bdd
	$recipe = $res->fetch(PDO::FETCH_ASSOC);

	echo '<div class="img">';
	echo '<br>';
	echo '<h2>' .$recipe['title'] . '</h2>';
	echo '<br>';
	echo '<p>Publié le : ' .date('d/ m/ Y', strtotime($recipe['date_add']));
	echo '<br><br>';
	echo '<img class="imgonerecipe" src="'.$recipe['link'].'">';
	echo '<br><br>';
	echo '<p class="detailtxt">' .$recipe['content'].'</p>';
	echo '<br>';
	echo '</div>';
	} else {
		echo 'Article introuvable !';
	}
}

require_once 'inc/footer.php';
