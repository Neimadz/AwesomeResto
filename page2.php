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

// création de la fonction curString à 4 paramètres
// $string = la chaîne tronquer
// $start = le caractère de départ
// $length = la longueur de la chaîne (en caractère)
// $endStr = paramètre optionnel qui termine l'extrait ([…] par défaut)
function cutString($string, $start, $length, $endStr = '[&hellip]'){
	// si la taille de la chaine est inférieure ou égale à celle
	// attendue on la retourne telle qu'elle
	if( strlen( $string ) <= $length ) return $string;
	// autrement on continue
 
	// permet de couper la phrase aux caractères définis tout
	// en prenant en compte la taille de votre $endStr et en 
	// re-précisant l'encodage du contenu récupéré
	$str = mb_substr( $string, $start, $length - strlen( $endStr ) + 1, 'UTF-8');
	// retourne la chaîne coupée avant la dernière espace rencontrée
	// à laquelle s'ajoute notre $endStr
	return substr( $str, 0, strrpos( $str,' ') ).$endStr;
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
					echo '<h2>'.cutString($entree['title'],0, 30, '...').'</h2><br>';
					echo '<img id="img" src="'.$entree['link'].'"><br><br>';
					echo '<p>'.cutString($entree['content'],0, 100, '...').'</p><hr>';
				}
			?>
		</div>
		<div class="recette col-sm-4 text-center">
			<h2 class="titre-p2">Nos plats</h2>
			<br>
			<?php
				foreach (selectCategory('dish') as $plat) {
					echo '<h2>'.cutString($plat['title'],0, 30, '...').'</h2><br>';
					echo '<img id="img" src="'.$plat['link'].'"><br><br>';
					echo '<p>'.cutString($plat['content'],0, 100, '...').'</p><hr>';
				}
			?>
		</div>
		<div class="recette col-sm-4 text-center">
			<h2 class="titre-p2">Nos desserts</h2>
			<br>
			<?php
				foreach (selectCategory('dessert') as $dessert) {
					echo '<h2>'.cutString($dessert['title'],0, 30, '...').'</h2><br>';
					echo '<img id="img" src="'.$dessert['link'].'"><br><br>';
					echo '<p>'.cutString($dessert['content'],0, 100, '...').'</p><hr>';
				}
			?>
		</div>
	</div>
</div>
<?php

include_once 'inc/footer.php';
?>

