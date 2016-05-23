<?php

require_once 'inc/connect.php';



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

	} else {
		echo 'Article introuvable !';
	}
}
require_once 'inc/header.php'
?>
	<div class="container">
		<div class="row">
			<div class="imgOneRecipe text-center">
				<br>
					<h2 class="readTitle"><?php echo $recipe['title'];?></h2>
				<br>
					<p class="readPublish">Publié le :<?php echo $recipe['date_publish'];?></p>
				<br>
					<div class="col-xs-12 col-sm-6 col-sm-offset-3">
						<div class="thumbnail center-block">
							<div class="index-recipe-img-container text-center">
						    	<img class="index-recipe-img" src="<?php echo $recipe['link'];?>">
						    	<div class="index-recipe-ingredients"><?php echo $recipe['ingredients'];?></div>
					    	</div>
							<?php echo $recipe['content'];?>
					    </div>
				  	</div>
			</div>
		</div>
	</div>
<?php  

require_once 'inc/footer.php';
