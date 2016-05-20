<?php 
require_once 'inc/connect.php';
include_once '../inc/functions.php';

// Tableau contenant l'ensemble des recettes
$allRecipes = array_merge(selectCategory('entrance'), selectCategory('dish'), selectCategory('dessert'));

//var_dump($allRecipes);

include_once 'inc/header.php';

foreach($allRecipes as $plat => $recettes){
	echo '<div class="row">';
		echo '<h3 class="title-list">'.$recettes['title'].'</h3><br>';
		echo '<img class="img-list col-sm-2" src="'.$recettes['link'].'">';
		echo '<div class="col-sm-6">';
			echo cutString($recettes['content'],0, 220, ' [...]').'<br><br>';
			echo '<p class="text-right"><strong>Ajouté le : </strong>'.$recettes['date_publish']."<strong> par : </strong><em>".$recettes['author_id'].'</em></p>';
		echo '</div>';
		echo '<div class="wrapper-buttons col-sm-4">';
			echo '<a href="update_article.php?='.$recettes['id'].'"><span class="glyphicon glyphicon-wrench"></span> Modifier</a><br>';
			echo '<a href="delete_article.php?='.$recettes['id'].'" onclick="return confirm(\'Êtes vous sur de vouloir supprimer cela ?\');"><span class="glyphicon glyphicon-remove"></span> Supprimer</a>';
		echo '</div>';
	echo '</div>';
}
var_dump($recettes);
include_once 'inc/footer.php';
?>
