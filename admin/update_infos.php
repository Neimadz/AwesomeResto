<?php

include_once 'header.php';

// On instancie nos variables qu'on utilisera plus tard
$post = array();
$error = array();
$displayErr = false;
$formValid = false;



	// On vérifie que notre formulaire n'est pas vide
	if(!empty($_POST)){
		// On recréer le tableau en le nettoyant des espaces vides en début et fin de chaine
		// et de l'éventuel code HTML / PHP
		foreach($_POST as $key => $value){
			$post[$key] = trim(strip_tags($value));
		}

		if(strlen($post['name']) < 4 || strlen($post['name']) > 15){
			$error[] = 'not a name';
		}	

		if(strlen($post['phone']) != 10 ){
			$error[] = 'not a phone';
		}

		/*if(!filter_var($post['email']) FILTER_VALIDATE_EMAIL){
			$error[] = 'not an email'; vérifier l'email
		}*/

		if(count($error) > 0){
			$displayErr = true;
		}
	
			else {
		
				// Ici je suis sur de ne pas avoir d'erreurs, donc je peux faire du traitement.
		
				$res = $bdd->prepare('UPDATE editaside SET link = :link, name = :name, phone = :phone, email = :email WHERE id = 1');

				// On complète les champs
				$res->bindValue(':link', $post['link']);
				$res->bindValue(':name', $post['name'], PDO::PARAM_STR);
				$res->bindValue(':phone', $post['phone'], PDO::PARAM_STR);
				$res->bindValue(':email', $post['email'], PDO::PARAM_BOOL);
			

				// retourne un booleen => true si tout est ok, false sinon
				if($res->execute()){
					// Pour afficher le message de réussite si tout est bon
					$formValid = true; 
				}
				else {
					// Permettra d'afficher les erreurs éventuelles
					die(print_r($res->errorInfo()));
				}
			}//fin de 1er else
		}//fin de if not empty $POST

	// Prépare et execute la requète SQL pour récuperer notre nveau $changeprofil
	$res = $bdd->prepare('SELECT * FROM editaside WHERE id = 1');
	$res->execute();

	// $changeprofil contient mon article extrait de la bdd
	$changeprofil = $res->fetch(PDO::FETCH_ASSOC);

	if($formValid){ // Si tout est ok, on affiche notre victoire !
		echo '<p style="color:green;"> GREAT !!</p>';
	}

	if($displayErr){ // Si on a des erreurs, on les affiche
		echo '<div class="errorContent">';
		echo implode('<br>', $error); // Permet de convertir le tableau $error en chaine de caractère
		echo '</div>';
	}
?>

<!-- formulaire changement à remplir pour changer coordonées user -->
<div>
	<form method="POST" class="pure-form">
    	<fieldset class="pure-group">
        	<input name="name" type="text" class="pure-input-1-2" placeholder="name">
        	<input name="phone" type="text" class="pure-input-1-2" placeholder="phone">
        	<input name="email" type="email" class="pure-input-1-2" placeholder="email">
       		<input name="link" type="link" class="pure-input-1-2" placeholder="link">
    	</fieldset>
		<button type="submit" class="pure-button pure-input-1-2 pure-button-primary">SUBMIT</button>
	</form>
</div>


<?php 

include_once 'aside.php';
include_once 'inc/footer.php';

?>   

