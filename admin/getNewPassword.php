<?php
require_once 'inc/connect.php';
require_once 'vendor/autoload.php';
include_once 'inc/header.php';


$error = [];
$post = [];

$showForm = true;
// Traitement des formulaires
if(!empty($_POST)) {
// Nettoyage des données
	foreach($_POST as $key => $value) {
		$post[$key] = trim(strip_tags($value));
	}

    // Traitement du formulaire du mail
    if(isset($post['email'])) {


    	if(filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
    		$req = $db->prepare('SELECT email FROM users WHERE email= :email');
    		$req->bindValue(':email', $post['email']);
    		$req->execute();

    		$emailExist = $req->fetchColumn();
    		if(!empty($emailExist)) {    // On search une corres avec le mail

    			$token = md5(uniqid()); // Création du token

    			$insert = $db->prepare('INSERT INTO tokens_password (email, token, date_create, date_exp) VALUES (:emailInsert, :tokenInsert, NOW(), NOW() + INTERVAL 2 DAY)');
    			$insert->bindValue(':emailInsert', $post['email']);
    			$insert->bindValue(':tokenInsert', $token);
                //insertion to the db
    			if($insert->execute()) {
                    // we compose a link to send
                    $magicLink = '<a href="'. $_SERVER['HTTP_HOST'].'/AwesomeResto/admin/lost_password.php?email='.$post['email'].'&token='.$token.'">Get new password</a>';

    		       	$mail = new PHPMailer;
    		        //$mail->SMTPDebug = 3;                               // Enable verbose debug output
    		        $mail->isSMTP();                                      // Set mailer to use SMTP
    	        	$mail->Host = 'smtp.mailgun.org'; // Specify main and backup SMTP servers
    	        	$mail->SMTPAuth = true;                               // Enable SMTP authentication
    	        	$mail->Username = 'postmaster@wf3.axw.ovh';                 // SMTP username
    	        	$mail->Password = 'WF3sessionPhilo2';                           // SMTP password
    	        	$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    	        	$mail->Port = 587;                                    // TCP port to connect to

    	        	$mail->setFrom('contact@monsupersite.fr', 'contact du site'); //expéditeur
    	        	$mail->addAddress($post['email'], '');  // Add a recipient// Name is optional
    	        	$mail->addReplyTo('info@example.com', 'Information');// si on l'enlève ça renvoie auto à l'expéditeur

    	       	 	$mail->isHTML(true);                                  // Set email format to HTML

    	        	$mail->Subject = 'Here is the subject';
    	        	$mail->Body    = $magicLink;
    	        	$mail->AltBody = $magicLink;

                    if(!$mail->send()) {
                		echo 'Le message ne peut être envoyé.';
               			echo 'Mailer Error: ' . $mail->ErrorInfo;
            		} else {
                        $showForm = false;
               			echo '<p class="noresult-msg">Le message a bien été envoyé sur votre boite de mail et nous vous remercions';
        			}
    			}//fin if insert execute
    		}//if empty emailexist
            else {
                echo 'Votre email n\'est pas enregistré!';
            }
    	}//fin filter var
		else
		{
		$error[] = 'Votre adresse email est incorrecte';
		}
    }// fin if EMPTYpost
}

if($showForm) {
 ?>

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

<?php
}
include_once 'inc/footer.php';
 ?>
