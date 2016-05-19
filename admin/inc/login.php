<?php
session_start();
require_once 'connect.php';

$error = [];
$post = [];
$showErrors = false;

if(!empty($_POST)){
	// Permet de nettoyer les données du formulaire. Équivalent à notre foreach() habituel
	$post = array_map('strip_tags', $_POST);
	$post = array_map('trim', $post);

	if(!filter_var($post['email'], FILTER_VALIDATE_EMAIL)){
		$error[] = 'Votre adresse email est invalide';
	}
	if(empty($post['password'])){
		$error[] = 'Vous devez saisir un mot de passe';
	}

	if(count($error) == 0){ // Aucune erreur
		// Je récupère l'utilisateur correspondant à l'adresse email
		$select = $db->prepare('SELECT * FROM users WHERE email = :email');
		$select->bindValue(':email', $post['email']);
		if($select->execute()){
			$user = $select->fetch(); // Contient notre utilisateur relatif à l'adresse email

			// Si $user n'est pas vide, c'est qu'il y a un utilisateur
			if(!empty($user)){
				// On vérifie le mot de passe saisi et le mot de passe hashé
				if(password_verify($post['password'], $user['password'])){
					// Ici le mot de passe est valide donc je stocke mes infos en sessions
					$_SESSION['user'] = [
						'id' 		=> $user['id'],
						'firstname' => $user['firstname'],
						'lastname' 	=> $user['lastname'],
						'email' 	=> $user['email'],
                        'role'      => $user['role'],
					];
					// Je redirige vers la page "admin.php"
					header('Location: admin.php');
					die;
				}
				else {
					// Le mot de passe est invalide
					$error[] = 'Le couple identifiant/mot de passe est invalide';
				}
			}
			else {
				// Utilisateur inconnu
				$error[] = 'Le couple identifiant/mot de passe est invalide';
			}
		}
	}
    else {
        $showErrors = true;
    }
}
 ?>
