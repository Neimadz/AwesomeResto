<?php 
require_once 'inc/connect.php';
require_once 'inc/header.php'; 
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

	echo '<h2> Recette </h2>';
foreach (selectCategory('entrance') as $entrance) {

	echo '<div>';
	echo $entrance['role'];
	echo '<h2>'.$entrance['title'].'</h2>
			 <br>
		 <img id="img" src="'.$entrance['link'].'">';
	echo  '<p>'.$entrance['content'] .'</p>';// En récuperant l'id de l'article; je peux
	echo '<span> Publié le'.date('d/m/Y', strtotime($entrance['date_publish'])).'<span>';
	echo '<hr>';

	echo '</div>';
}

foreach (selectCategory('dish') as $dish) {

	echo '<div>';
	echo $dish['role'];
	echo '<h2>'.$dish['title'].'</h2>
			 <br>
		 <img id="img" src="'.$dish['link'].'">';
	echo  '<p>'.$dish['content'] .'</p>';// En récuperant l'id de l'article; je peux
	echo '<span> Publié le'.date('d/m/Y', strtotime($dish['date_publish'])).'<span>';
	echo '<hr>';

	echo '</div>';
}

foreach (selectCategory('dessert') as $des) {

	echo '<div>';
	echo $des['role'];
	echo '<h2>'.$des['title'].'</h2>
			 <br>
		 <img id="img" src="'.$des['link'].'">';
	echo  '<p>'.$des['content'] .'</p>';// En récuperant l'id de l'article; je peux
	echo '<span> Publié le'.date('d/m/Y', strtotime($des['date_publish'])).'<span>';
	echo '<hr>';

	echo '</div>';
}


include_once 'inc/footer.php';
?>

