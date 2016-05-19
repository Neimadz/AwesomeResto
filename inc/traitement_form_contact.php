<?php
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
        $error[] = 'Please enter your name';
    }
        
    // Check if email has been entered and is valid
    if (!$post['email'] || !filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
        $error[] = 'Please enter a valid email address';
    }
    
    //Check if message has been entered
    if (!$post['message']) {
        $error[] = 'Please enter your message';
    }
    //Check if simple anti-bot test is correct
    if ($human !== 11) {
        $error[] = 'Your anti-spam is incorrect';
    }
    
    if(count($error) > 0){
        $displayErr = true; 
    }
    else {
        $formValid = true;
        
        $res = $bdd->prepare('INSERT INTO contact (name, email, message, date_send) VALUES(:name, :email, :message, NOW())');

        $res->bindValue(':name', $post['name']);
        $res->bindValue(':email', $post['email']);
        $res->bindValue(':message', $post['message']);
    
        if($res->execute()){
            // the message has been sent to the data base
             echo 'You did it!';
        }//end if
    }// end else
}//end emty

    if ($displayErr){
        echo '<p>' .implode('<br>', $error). '<p>';
        }

    require_once 'inc/header.php';
?>