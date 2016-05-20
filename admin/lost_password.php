<?php

session_start();

require_once 'inc/connect.php';
include_once 'inc/header.php';

$error = [];
$post = [];

$showFormEmail = true;    // On affiche le 1er formulaire de saisie de l email
$showFormPassword = false; // On affiche le 2nd formulaire de mise à jour de notre mdp
 
if(isset($_GET['token']) && !empty($_GET['token']) && isset($_POST['email']) && !empty($_POST['email'])) {
	$showFormEmail = false;   
	$showFormPassword = true;
}

// Traitement des formulaires 
if(!empty($_POST)) {
// Nettoyage des données
	foreach($_POST as $key => $value) {
		$post[$key] = trim(strip_tags($value));
	}

// Traitement du formulaire du mail
if(isset($post['action']) && $post['action'] == 'generateToken') {
var_dump($post);
	if(filter_var($post['email_password'], FILTER_VALIDATE_EMAIL)) {
		$req = $db->prepare('SELECT email from users WHERE email= :email');
		$req->bindValue(':email', $post['email_password']);
		$req->execute();

		$emailExist = $req->fetchColumn();

		if(!empty($emailExist)) {    // On search une corres avec le mail

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
		        //$mail->SMTPDebug = 3;                               // Enable verbose debug output
		        $mail->isSMTP();                                      // Set mailer to use SMTP
	        	$mail->Host = 'smtp.mailgun.org'; // Specify main and backup SMTP servers
	        	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	        	$mail->Username = 'postmaster@wf3.axw.ovh';                 // SMTP username
	        	$mail->Password = 'WF3sessionPhilo2';                           // SMTP password
	        	$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
	        	$mail->Port = 587;                                    // TCP port to connect to

	        	$mail->setFrom('contact@monsupersite.fr', 'contact du site'); //expéditeur
	        	$mail->addAddress('contact.myriambugnazet@gmail.com', 'millaa');  // Add a recipient// Name is optional
	        	$mail->addReplyTo('info@example.com', 'Information');// si on l'enlève ça renvoie auto à l'expéditeur

	       	 	$mail->isHTML(true);                                  // Set email format to HTML

	        	$mail->Subject = 'Here is the subject';
	        	$mail->Body    = $post['message'];
	        	$mail->AltBody = $post['message'];
			}//fin if insert execute
    			
    		if(!$mail->send()) {
        		echo 'Le message ne peut être envoyé.';
       			echo 'Mailer Error: ' . $mail->ErrorInfo;
    		} else {
       			echo 'Le message a bien été envoyé et nous vous remercions';	
			}

		}//if empty emailexist
	}//fin filter var

		else 
		{
		$error[] = 'Votre adresse email est incorrecte';
		}
}// fin if EMPTYpost

	// Traitement du 2nd formulaire concernant la maj du mdp
	elseif(isset($post['action']) && $post['action'] == 'updatePassword') {

		if(strlen($post['new_password']) < 8 || strlen($post['new_password']) > 25 ) { // Nbres de caractères modifiables 
			$error[] = 'Votre mot de passe doit contenir entre 8 et 25 caractères';
		}

		if($post['new_password'] != $post['new_password_conf']) {
			$error[] = 'Vos mots de passe doivent correspondre';
		}

		if(count($error) == 0 ) { // On compte nos erreurs, vérif du token et du mail
			$token = $db->prepare('SELECT * FROM tokens_password WHERE email = :email AND token = :token AND date_exp < NOW()');
		$token->bindValue(':email', $post['email']);
		$token->bindValue(':token', $post['token']);
		$token->execute();

		$tokenExist = $token->fetch();

		if(empty($tokenExist)) {
			$error[] = ' Le token et l\'adresse email ne correspondent pas. !';
		} 
		else {
			// Ici, on peut ENFIN changer ce putain de mot de passe :-)
			$update = $db->prepare('UPDATE users SET password = :password WHERE email = :email');
			$update->bindValue(':password', password_hash($post['new_password'], PASSWORD_DEFAULT)); // On insère le mot de passe hashé
			$update->bindValue(':email', $post['email']);
			if($update->execute()) {
				$successUpdate = true;

	        // Suppression du token car le mdp est modifié
				$delete = $db->prepare('DELETE FROM tokens_password WHERE id = :idToken');
				$delete->bindValue(':idToken', $tokenExist['id'], PDO::PARAM_int);// $tokenExist contient les infos de mon token extraites de la base de données.. et donc son ID 
				$delete->execute();
			}//fin if udpdate
		} //fin else
	}//fin if count
	}//fin elsif

}//fin if isset
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
		<!-- Affichage du formulaire avec notre adresse mail -->
 	<form class="form-horizontal well-well-sm" method="post">
 	    <div class="form-group">
 	        <label class="col-md-4 control-label" for="email">Email : </label>
 	        <div class="col-md-4">
 	            <input id="email" type="email" name="email" placeholder="votre@gmail.com" class="form-control input-md" required>
 	        </div>
 	    </div>

 	    <div class="form-group">
 	        <div class="col-md-4 col-md-offset-4">
 	            <button type='submit' class="btn btn-primary">Envoyez moi un nouveau de passe !</button>
 	        </div>
 	    </div> 
 	</form> 

<?php endif; ?> 
<?php endif; // Fermeture du ifelse de $showFormEmail ?>

 	<?php if(isset($showFormPassword) && $showFormPassword == true): ?>

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

 	<?php endif; ?><!-- fermeture isset showformpassword -->


