<?php

session_start();

require_once 'inc/connect.php';
include_once 'inc/header.php';

$error = [];
$post = [];
$showFormPassword = false; // On affiche le 2nd formulaire de mise à jour de notre mdp
$showConnectButton = false;

if(isset($_GET['token']) &&
  !empty($_GET['token']) &&
  isset($_GET['email']) &&
  !empty($_GET['email'])) {

	$showFormPassword = true;
    //var_dump($_POST);
	// Traitement du 2nd formulaire concernant la maj du mdp
	if(isset($_POST['action']) && $_POST['action'] == 'updatePassword') {

        foreach ($_POST as $key => $value) {
            $post[$key] = trim(strip_tags($value));
        }

        //var_dump($post);

		if(strlen($post['new_password']) < 8 || strlen($post['new_password']) > 25 ) { // Nbres de caractères modifiables
			$error[] = 'Votre mot de passe doit contenir entre 8 et 25 caractères';
		}

		if($post['new_password'] != $post['new_password_conf']) {
			$error[] = 'Vos mots de passe doivent correspondre';
		}

		if(count($error) == 0 ) { // On compte nos erreurs, vérif du token et du mail
			$token = $db->prepare('SELECT * FROM tokens_password WHERE email = :email AND token = :token');
    		$token->bindValue(':email', $_GET['email']);
    		$token->bindValue(':token', $_GET['token']);
    		$token->execute();
            //var_dump($post);
    		$tokenExist = $token->fetch(PDO::FETCH_ASSOC);
    		if(!empty($tokenExist) && ($tokenExist['date_exp'] > date('Y-m-d H:i:s'))) {
                // Ici, on peut ENFIN changer ce putain de mot de passe :-)
    			$update = $db->prepare('UPDATE users SET password = :newPassword WHERE email = :newEmail');
                $update->bindValue(':newEmail', $_GET['email']);
    			$update->bindValue(':newPassword', password_hash($post['new_password'], PASSWORD_DEFAULT)); // On insère le mot de passe hashé

    			if($update->execute()) {
    				$successUpdate = true;

    	        // Suppression du token car le mdp est modifié
    				$delete = $db->prepare('DELETE FROM tokens_password WHERE id = :idToken');
    				$delete->bindValue(':idToken', $tokenExist['id'], PDO::PARAM_INT);// $tokenExist contient les infos de mon token extraites de la base de données.. et donc son ID
    				if($delete->execute()) {
                        $showFormPassword = false;
                        $showConnectButton = true;
                        echo '<div class="alert alert-success">Votre mot de passe a été bien changé, Ne l\'oublié plus :)</div>';
                    }
    		}
    		else {
                $error[] = ' Le token et l\'adresse email ne correspondent pas ou la date est expiré !';
    			}//fin if udpdate
    		} //fin else
	    }//fin if count
        else {
            echo '<div class="alert alert-danger">';
            echo implode('<br>', $error);
            echo '</div>';
        }
	}//fin elsif

}//fin if isset
?>

<main class="container">
<h1 class="text-center">Mot de passe oublié ?</h1>
<br>

<?php if(isset($showFormPassword) && $showFormPassword == true) { ?>

	<form class="form-horizontal well well-sm" method="post">
        <input type="hidden" name="action" value="updatePassword">
        <!-- <input type="hidden" name="email" value="<?=$_GET['email'];?>">
        <input type="hidden" name="token" value="<?=$_GET['token'];?>"> -->
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

<?php
}

if ($showConnectButton) {
?>
<a href="index.php" role="link">Connectez-vous avec le nouveau mot de pass, svp</a>

<?php
}
?><!-- fermeture isset showformpassword -->
