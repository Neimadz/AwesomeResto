<?php
require_once 'connect.php';
//creation variables 
$post = array();
$error = array();
$displayErr = false;
$formValid = false;

//Check if form is not empty
if(!empty($_POST)) {      
    // Recreate clean up table 
    // also for HTML / PHP
    foreach($_POST as $key => $value){
        $post[$key] = trim(strip_tags($value));
    }
      
    // Check if name has been entered
    if (!$post['name']) {
        $error[] = 'Entrez votre nom';
    }
        
    // Check if email has been entered and is valid
    if (!$post['email'] || !filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
        $error[] = 'Entrez une adresse valide';
    }
    
    //Check if message has been entered
    if (!$post['message']) {
        $error[] = 'Entrez un message';
    }
    
    if(count($error) > 0){
        $displayErr = true; 
    }
    else {
        $formValid = true;
        
        $res = $db->prepare('INSERT INTO contact (name, email, message, date_send) VALUES(:name, :email, :message, NOW())');

        $res->bindValue(':name', $post['name']);
        $res->bindValue(':email', $post['email']);
        $res->bindValue(':message', $post['message']);
        if($success = $res->execute()){
                echo '<p class="alert alert-success"> Votre message à bien été envoyé!';
        }
            // the message has been sent to the data base  
    }// end else
    
    if ($displayErr){
        echo '<p class="alert alert-danger">' .implode('<br>', $error). '<p>';
        }
}//end emty
?>