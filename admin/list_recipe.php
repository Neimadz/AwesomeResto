<?php 
require_once 'inc/connect.php';
include_once '../inc/functions.php';

// Tableau contenant l'ensemble des recettes
$allRecipes = array_merge(selectCategory('entrance'), selectCategory('dish'), selectCategory('dessert'));

//var_dump($allRecipes);

require_once 'inc/header.php';
foreach($allRecipes as $plat => $recettes){
	echo '<div class="wrapper-list row">';
		echo '<h3>'.$recettes['title'].'</h3><br>';
		echo '<img class="img-list col-sm-2" src="'.$recettes['link'].'">';
		echo '<div class="wrapper-content col-sm-6">'.cutString($recettes['content'],0, 150, '...')."</div>";
		echo '<div class="wrapper-buttons col-sm-4">Lorem ipsom toussa toussa</div>';
	echo '</div>';
}
?>
