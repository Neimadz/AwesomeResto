<?php 
session_start();
require_once 'inc/connect.php';
include_once '../inc/functions.php';

$deleteOk = false;
if(!empty($_GET)){

	foreach($_GET as $key => $value){
		$get[$key] = trim(strip_tags($value));
	}

	$res= $db->prepare('DELETE FROM recipes WHERE id = :idArticle');
	$res->bindValue(':idArticle', $get['id'], PDO::PARAM_INT);
	
	if($res->execute()){
		$deleteOk = true;
	}
}

include_once 'inc/header.php';

if($deleteOk): ?>
	<div class="alert alert-success" role="alert">La recette a bien été supprimé.</div>
			
		<div class="form-group">
            <button onclick="window.location.href='list_recipe.php'" class="btn btn-primary">Retour liste article</button>
        </div>
<?php 
else:
	echo '<div class="alert alert-danger" role="alert">';
		echo 'Problème lors de la supression, contactez l\'administrateur';
	echo '</div>';
endif;