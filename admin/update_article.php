<?php 

require_once 'inc/connect.php';
include_once 'inc/functions.php';
logged_only();

$post = array();
$errors = array();
$displayErr = false; // show errors
$formValid = false; // form was filled well and data was inserted to the db
$errIns = false;
$possibleRole = ['entrance', 'dish', 'dessert']; // acceptable values

// Permet de s'assurer qu'un paramètre GET ait bien été transmis et qu'il est de de type numérique 
if(isset($_GET['id']) && !empty($_GET['id'])){
	$idRecette = $_GET['id']; 
	if(!is_numeric($idRecette)){
		$idRecette = 1;
	}

/**************************************************/
/**********TRAITEMENT DE LA MISE A JOUR************/
/**************************************************/

	if(isset($idRecette)){
		// On vérifie que notre formulaire n'est pas vide
		if(!empty($_POST)){
			// On recréer le tableau en le nettoyant des espaces vides en début et fin de chaine
			// et de l'éventuel code HTML / PHP
			foreach($_POST as $key => $value){
				$post[$key] = trim(strip_tags($value));
			}
			// verification
		    if(verif(("#^.{5,140}$#"), $post['title'])){
		      $errors[] = 'Le titre de la recette doit comporter entre 5 et 140 cractères';
		    }
		    if(verif(("#^.{20,}$#"), $post['content'])){
		      $errors[] = 'Le contenu doit faire au moins 20 caractères';
		    }
		    if(!filter_var($post['link'], FILTER_VALIDATE_URL)) {
		      $errors[] = 'Le lien de l\'image n\'est pas valide';
		    }
		    if(empty($post['ingredients'])) {
		      $errors[] = 'La listes d\'ingrédients doit être complète';
		    }
		    if(empty($post['role']) || !in_array($post['role'], $possibleRole)) {
		      $errors[] = 'Précisez la catégorie, svp';
		    }
			if(count($errors) > 0) {
	        $displayErr = true;
	        }
		    else {
		        // get authors id of logged user
		        //$authorId = $_SESSION['user']['id'];

		        $res = $db->prepare('UPDATE recipes SET 
		        		role = :newRole,
		        		title = :newTitle,
		        		content = :newContent,
		        		link = :newLink,
		        		ingredients = :newIngredients
		        	WHERE id = :idDeMonArticle');
				// On passe l'id de l'article pour ne mettre à jour que l'article en cours d'edition (clause WHERE)
				$res->bindValue(':idDeMonArticle', $post['id_recette'], PDO::PARAM_INT);
				$res->bindValue(':newTitle', $post['title']);
				$res->bindValue(':newContent', $post['content']);
				$res->bindValue(':newLink', $post['link']);
				$res->bindValue(':newIngredients', $post['ingredients']);
				$res->bindValue(':newRole', $post['role']);

				if($res->execute()){
					$formValid = true; // Pour afficher le message de réussite si tout est bon
				}
				else {
					$errIns = true;
				}
			}
		}
	}

	/**************************************************/
	/***********RECUPERATION DE L'ARTICLE**************/
	/**************************************************/
	// Prépare et execute la requète SQL pour récuperer notre article de manière dynamique
		$res = $db->prepare('SELECT * FROM recipes WHERE id = :idArticle');
		$res->bindParam(':idArticle', $idRecette, PDO::PARAM_INT);
		$res->execute();

	// $article contient mon article extrait de la bdd
		$recette = $res->fetch(PDO::FETCH_ASSOC);

	include_once 'inc/header.php';

	if($formValid):// Si tout est ok, on affiche notre victoire ! ?>
	
		<div class="alert alert-success" role="alert">Cette recette a été bien mise à jour.</div>
			
		<div class="form-group">
            <button onclick="window.location.href='list_recipe.php'" class="btn btn-primary">Retour liste article</button>
        </div>
	<?php endif;

	if($displayErr){ // Si on a des erreurs, on les affiche
		echo '<div class="alert alert-danger" role="alert"></ul>';
	        foreach ($errors as $err) {
	            echo '<li>'. $err . '</li>';
	        }
	    echo '</ul></div>';
	}
	if($errIns){
		echo '<div class="alert alert-danger" role="alert">';
			echo 'Problème lors de la mise à jour, contactez l\'administrateur';
		echo '</div>';
	}
	?>

	<h1>Modifier une recette</h1>

	<form id="add-recipe-form" method="post">
	    <div class="form-group">
	        <label for="role">Catégorie :</label>
	        <?php recupRole($recette['role']) ?>	
	    </div>

	    <div class="form-group">
	        <label for="title">Titre : </label>
	        <input type="text" id="add-title" class="form-control" name="title" value="<?php echo $recette['title'] ?>">
	    </div>

	    <div class="form-group">
	        <label for="content">Description : </label><br>
	        <textarea name="content" id="add-content" class="form-control" row="60" cols="50" ><?php echo $recette['content']?></textarea>
	    </div>

	    <div class="form-group">
	        <label for="link">Votre image : </label>
	        <input type="text" id="add-link" class="form-control" name="link"  value="<?php echo $recette['link'] ?>">
	    </div>

	    <div class="form-group">
	        <label for="ingredients">Vos ingrédients : </label><br>
	        <textarea name="ingredients" id="add-ingredients" class="form-control" row="60" cols="50" ><?php echo $recette['ingredients'] ?></textarea>
	    	<?php echo '<input type="hidden" name="id_recette" value="'.$recette['id'].'">';?>
	    </div>

	    <input type="submit" class="btn btn-primary" value="Modifier la recette">
	</form>
<?php } ?>
