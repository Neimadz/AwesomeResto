<?php 
require_once 'inc/connect.php';
include_once '../inc/functions.php';

// Tableau contenant l'ensemble des recettes
$allRecipes = array_merge(selectCategory('entrance'), selectCategory('dish'), selectCategory('dessert'));

//var_dump($allRecipes);

include_once 'inc/header.php';

foreach($allRecipes as $plat => $recettes){
	echo '<div class="row">';
		echo '<h3>'.$recettes['title'].'</h3><br>';
		echo '<img class="img-list col-sm-2" src="'.$recettes['link'].'">';
		echo '<div class="col-sm-6">'.cutString($recettes['content'],0, 300, '...')."</div>";
		echo '<div class="wrapper-buttons col-sm-4">';
			echo '<a href=""><span class="glyphicon glyphicon-wrench"></span> Modifier</a><br>';
			echo '<a href=""><span class="glyphicon glyphicon-remove"></span> Supprimer</a>';
		echo '</div>';
	echo '</div>';
}
include_once 'inc/footer.php';
?>
