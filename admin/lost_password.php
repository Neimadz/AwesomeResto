<?php

session_start();

require_once 'inc/connect.php';
include_once 'inc/header.php';

$error = [];
$post = [];

$showFormEmail = true;    // On affiche le 1er formulaire de saisie de l email
$showFormPassword = false; // On affiche le 2nd formulaire de mise à jour de notre mdp


// On masque le 1er formulaire si token et email dans le GET pour afficher le 2nd
if(isset($_GET['token']) && !empty($_GET['token']) && isset($_GET['email']) && !empty($_GET['email'])) {
	$showFormEmail = false;   
	$showFormPassword = true;
}
// Traitement des formulaires 
if(!empty($_POST)) {
	// Nettoyage des données
	foreach($_POST as $k => $v) {
		$post[$k] = $v;
	}
// Traitement du formulaire du mail
	if(isset($post['action']) && $post['action'] == 'generateToken') {
		if(filter_var($post['email_password'], FILTER_VALIDATE_EMAIL)) {
			$sql = $db->prepare('SELECT email from users WHERE email= :email');
			$sql->bindValue(':email', $post['email_password']);
			$sql->execute();
			$ifMailExist = $sql->fetchColumn();

			if(!empty($ifMailExist)) {    // On search une corres avec le mail
				$token = md5(uniqid()); // Création du token

				$insert = $db->prepare('INSERT INTO tokens_password (email, token, date_create, date_exp) VALUES (
					:emailInsert,
					:tokenInsert,
					NOW(),
					(NOW() + INTERVAL 2 DAYS))
					');
				$insert->bindValue(':emailInsert', $post['email_password']);
				$insert->bindValue(':tokenInsert', $token);
				if($insert->execute()) {
					
		        $mail = new PHPMAILER;
		        $mail->isSMTP();                                      
                $mail->Host = 'smtp.mailgun.org';  
                $mail->SMTPAuth = true;                               
                $mail->Username = '';                 
                $mail->Password = '';                           
                $mail->SMTPSecure = 'tls';                           
                $mail->Port = 587;                                   

                $mail->setFrom($post['email'], $post['firstname'] );
                $mail->addAddress('user@gmail.com', ' Anastasia Admin'); 
        
                $mail->isHTML(true);                                  

                $mail->Subject = 'Voici un lien pour générer un nouveau mot de passe : generate_new_password.php';
                $mail->Body    = $post['content'];
                $mail->AltBody = $post['content'];

        			if(!$mail->send()) {
            			echo 'Le message ne peut être envoyé.';
           				 echo 'Mailer Error: ' . $mail->ErrorInfo;
        				} else {
           				 echo 'Le message a bien été envoyé et nous vous remercions';
        				}		
					}
			}		
		}
	}






	// Traitement du 2nd formulaire concernant la maj du mdp
	elseif(isset($post['action']) && $post['action'] == 'updatePassword') {
		if(strlen($post['new_password']) < 8 || strlen($post['new_password']) > 25 ) { // Nbres de caractères modifiables 
			$error[] = 'Votre mot de passe doit contenir entre 8 et 25 caractères';
		}
		if($post['new_password'] != $post['new_password_conf']) {
			$error[] = 'Vos mots de passe doivent correspondre';
		}
		if(count($error) == 0 ) { // On compte nos erreurs, vérif du token et du mail
			$token = $db->prepare('SELECT * FROM tokens_password WHERE email = :postEmail AND token = :postToken AND date_exp < NOW()');
			$token->bindValue(':postEmail', $post['email']);
			$token->bindValue(':postToken', $post['token']);
			$token->execute();

			$tokenExist = $token->fetch();

			if(empty($tokenExist)) {
				$error[] = 'Il ya une erreur !';
			} 
			else {
				// Changement du mdp
				$update = $db->prepare('UPDATE users SET password = :newPassword WHERE email = :email');
				$update->bindValue(':newPassword', password_hash($post['new_password'], PASSWORD_DEFAULT));
				$update->bindValue(':email', $post['email']);
				if($update->execute()) {
					$successUpdate = true;

                // Suppression du token car le mdp est modifié
					$delete = $db->prepare('DELETE FROM tokens_password WHERE id = :idToken');
					$delete->bindValue(':idToken', $tokenExist['id'], PDO::PARAM_int).
					$delete->execute();
				}

			}
		}
	}

}
?>

 <main class="container">
 	<h1 class="text-center">Mot de passe oublié ?</h1>
 	<br>
 	<?php if(!empty($error)): // Affichage des erreurs si êrror n est pas vide ?>
 		<div class="alert alert-danger">
 		    <?=implode('<br>', $error); ?>
 		</div>
 	<?php endif; ?>
 	
 	<?php if(isset($showFormEmail) && $showFormEmail == true): // Affichage du 1er form?>
    <?php if(isset($linkChangePassword)): // mail ok et token inséré?>	

 	<p>Vous pouvez réinitialiser votre mot de passe en cliquant sur le lien ci dessous : 
 	<br>
 	<a href="<?=$linkChangePassword; ?>">Modifier votre mot de passe</a>   <!-- Vérif si lien ok-->
 	</p>
 	<br>

 	<code><?=$linkChangePassword; ?></code>        <!-- Vérif si ok -->

 <?php else: // Affichage du form ?>

 	<form class="form-horizontal well well-sm" method="post">
            <input type="hidden" name="action" value="updatePassword">
            <input type="hidden" name="email" value="<?=$_GET['email'];?>">
            <input type="hidden" name="token" value="<?=$_GET['token'];?>">
            <div class="form-group">
                <label class="col-md-4 control-label" for="new_password">Votre nouveau mot de passe</label>
                <div class="col-md-4">
                    <input type="password" name="new_password" id="new_password" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label" for="new_password_conf">Confirmation du mot de passe</label>
                <div class="col-md-4">
                    <input type="password" name="new_password_conf" id="new_password_conf" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-4 col-md-offset-4">
                    <button type="submit" class="btn btn-default">Mettre à jour mon mot de passe</button>
                </div>
            </div>
        </form> 
    <?php endif; ?> 
 <?php endif; // Fermeture du ifelse de $linkChangePassword ?>




