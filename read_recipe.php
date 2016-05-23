<?php

require_once 'inc/connect.php';



/* On vérifie que l'ID de la recette existe et n'est pas vide
Si l'id n'est pas de type numérique, on force la valeur à 1
*/
/*if(isset($_GET['id']) && !empty($_GET['id'])){
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
	$recipe = $res->fetch(PDO::FETCH_ASSOC);*/

/********************************VERSION INNER JOIN SQL ***************************************/

if(isset($_GET['id']) && !empty($_GET['id'])){
	$userRecipes = $_GET['id']; 
	if(!is_numeric($userRecipes)){
		$userRecipes = 1;
	}
}

if(!empty($_GET)){
	if(isset($userRecipes)){
	$res = $db->prepare('SELECT * FROM recipes INNER JOIN users WHERE recipes.id = users.id and users.id = :id ');
	$res->bindParam(':id', $userRecipes, PDO::PARAM_INT);
	if($res->execute()){
		// $recipe contient mon recipe extrait de la bdd
		$recipe = $res->fetch(PDO::FETCH_ASSOC);
	}

	
	} else {
		echo 'Article introuvable !';
	}
}
require_once 'inc/header.php'
?>
	<div class="container">
		<div class="row">
			<div class="imgOnejoin text-center">
				<br>
					<h2 class="readTitle"><?php echo $recipe['title'];?></h2>
				<br>
				<h2 class="readTitle"><?php echo $recipe['firstname']. ' ' .$recipe['lastname'];?></h2>
				<br>
					<p class="readPublish"> Disponible depuis le :<?php echo $recipe['date_publish'];?></p>
				<br>
					<div class="col-xs-12 col-sm-6 col-sm-offset-3">
						<div class="thumbnail center-block">
							<div class="index-recipe-img-container text-center">
						    	<img class="index-recipe-img" src="<?php echo $recipe['link'];?>">
						    	<br>
						    	<div class="index-recipe-ingredients"><?php echo $recipe['ingredients'];?></div>
					    	</div>
							<?php echo $recipe['content'];?>
					    </div>
				  	</div>
			</div>
			<div class="img_print">
		        <p><i class="fa fa-print" aria-hidden="true"></i> Print it</p>
		        <p><a href="https://facebook.com"><i class="fa fa-facebook" aria-hidden="true"></i> Share it</a></p>
		        <p><a href="https://fr.pinterest.com/"><i class="fa fa-pinterest-p" aria-hidden="true"></i>Pint it</a></p>
		    </div>			
		</div>
	</div>
<?php  

require_once 'inc/footer.php';
