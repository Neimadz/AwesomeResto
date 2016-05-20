<?php

require_once 'connect.php';

function showArticles($art) {
    echo '<article>';
    echo '<h2 class="recipe-title">'.$art['title'].'</h2>';
    echo '<p class="recipe-date">'.$art['date_publish'].'</p>';
    echo '<p class="recipe-author">Auteur :'.$art['author_id'].'</p>';
    echo '<p class="recipe-ingr">'.$art['ingredients'].'</p>';
    echo '<p class="recipe-p">'.$art['content'].'</p>';
    echo '<img src="'.$art['link'].'">';
    echo '</article>';
}

function showSearchResult($art, $key) {
    echo '<article>';
	echo '<h1>' . str_ireplace($key, '<span style="padding:5px;background-color:#E08283;color:#fff;">' . $key . '</span>', $art['title']) . '</h1>';
	echo '<p class="art-date">Publié le ' . $art['date_publish'] . '</p>';
	echo '<img class="article-img" src="' . $art['link'] . '">';
	echo '<p>' . str_ireplace($key, '<span style="padding:0 5px;background-color:#E08283;color:#fff;">' . $key . '</span>', $art['content']) . '</p>';
	echo '</article>';
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

//Fonction pour la page index
function selectCategoryIndex($role){
	global $db; // Va chercher la variable $db qui se trouve hors de la fonction

	// Prépare et execute la requète SQL
	$debut = $db->prepare('SELECT * FROM recipes WHERE role = :assoc ORDER BY date_publish ASC LIMIT 1');
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
