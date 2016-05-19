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
            // Ici tout est ok, on fait la redirection
            header('Location: index.php?id='.$bdd->lastInsertId());
            die; // On met le die, uniquement pour être sur qu'on soit redirigé
        }
        }
    }//emty

    require_once 'inc/header.php';
?>

    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <h1 class="page-header text-center"> Contactez nous </h1>
                <form class="form-horizontal" role="form" method="post" action="index.php">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" name="name" placeholder="First & Last Name" value="<?php echo htmlspecialchars($_POST['name']); ?>">
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="email" name="email" placeholder="example@domain.com" value="<?php echo htmlspecialchars($_POST['email']); ?>">
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message" class="col-sm-2 control-label">Message</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="4" name="message"><?php echo htmlspecialchars($_POST['message']);?></textarea>
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="human" class="col-sm-2 control-label"> 8 + 3 = ?</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="human" name="human" placeholder="Your Answer">
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-2">
                            <input id="submit" name="submit" type="submit" value="Send" class="btn btn-primary">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-2">
                        </div>
                    </div>
                </form> 
            </div>
        </div>
    </div>   
    
<?php include_once 'inc/footer.php'; ?>