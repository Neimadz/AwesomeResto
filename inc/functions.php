<?php

require_once 'connect.php';

function showArticles($art) {
    echo '<h2 class="article-title">'.$art['title'].'</h2>';
    echo '<p class="article-date">'.$art['date_publish'].'</p>';
    echo '<p class="article-ingr">'.$art['ingredients'].'</p>';
    echo '<p class="article-p">'.$art['content'].'</p>';
    echo '<img src="'.$art['link'].'">';
}

/********Fonction permétant de sélectionner les recettes en fonctions de leur role***********/
function selectCategory($role){
	global $db; // Va chercher la variable $db qui se trouve hors de la fonction

	// Prépare et execute la requète SQL
	$debut = $db->prepare('SELECT * FROM recipes WHERE role = :assoc ORDER BY date_publish ASC');
	$debut->bindValue(':assoc', $role);
	$debut->execute();

	// Retourne tous les roles de la table "recipes" indiqué dans la fonction sous forme de array()
	return $debut->fetchAll(PDO::FETCH_ASSOC);
}


/*******Fonction permettant de limiter le nombre de caractères affichés***********/

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

?>
