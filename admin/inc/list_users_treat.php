<?php
require_once 'connect.php';
$post = [];
$errors = [];
$possibleRole = ['admin', 'edit'];

if(!empty($_POST)) {
    foreach ($_POST as $key => $value) {
        $post[$key] = trim(strip_tags($value));
    }
    //var_dump($post);
    // verification
    if(empty($post['user-add-role']) || !in_array($post['user-add-role'], $possibleRole)) {
        $errors[] = 'Le role ne doit pas etre vide.';
    }
    if(strlen($post['user-add-firstname']) < 3 || strlen($post['user-add-firstname']) > 50) {
      $errors[] = 'Prenom doit comporter entre 3 et 50 cractères';
    }
    if(strlen($post['user-add-lastname']) < 3 || strlen($post['user-add-lastname']) > 50) {
      $errors[] = 'Nom doit comporter entre 3 et 50 cractères';
    }

    if(verif('/[a-zA-Z0-9-.+]+@[a-zA-Z0-9-]+.[a-zA-Z]/', $post['user-add-email'])) {
        $errors[] = 'Email n\'est pas correct';
    }

    if(verif('/^[\w\d]{6,20}$/', $post['user-add-email'])) {
        $errors[] = 'Password doit comporter entre 8 et 20 characteres';
    }
    // ACTION!
    if(count($errors) > 0) {
        echo '<div class="alert alert-danger" role="alert"></ul>';
        foreach ($errors as $err) {
            echo '<li>'. $err . '</li>';
        }
        echo '</ul></div>';
    }
    else {

        $addUser = $db->prepare('INSERT INTO users (firstname, lastname, role, email, password, date_registration) VALUES(:newFname, :newLname, :newRole, :newEmail, :newPassword, NOW())');
        $addUser->bindValue(':newFname', $post['user-add-firstname']);
        $addUser->bindValue(':newLname', $post['user-add-lastname']);
        $addUser->bindValue(':newRole', $post['user-add-role']);
        $addUser->bindValue(':newEmail', $post['user-add-email']);
        $addUser->bindValue(':newPassword', password_hash($post['user-add-password'], PASSWORD_DEFAULT));
        if($addUser->execute()) {
            echo '<div class="alert alert-success" role="alert">Cet user a été bien ajoutée.</div>';
        }
        else {
            echo '<div class="alert alert-success" role="alert">Cet user n\'a pas été ajoutée.</div>';
        }
    }

}


?>
