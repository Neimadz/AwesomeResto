<?php
session_start();
require_once 'connect.php'; // dosn't work without

$post = array();
$error = array();
$displayErr = false; // show errors
$formValid = false; // form was filled well and data was inserted to the db
$possibleRole = ['entrance', 'dish', 'dessert']; // acceptable values

if(!empty($_POST)) {
    // clean user input
    foreach($_POST as $key => $value){
      $post[$key] = trim(strip_tags($value));
    }
    // verification
    if(strlen($post['title']) < 5 || strlen($post['title']) > 200) {
      $error[] = 'Le titre de la recette doit comporter entre 5 et 200 cractères';
    }
    if(empty($post['content'])) {
      $error[] = 'Le contenu ne peut être vide';
    }
    if(!filter_var($post['link'], FILTER_VALIDATE_URL)) {
      $error[] = 'Le lien de l\'image n\'est pas valide';
    }
    if(empty($post['ingredients'])) {
      $error[] = 'La listes d\'ingrédients doit être complète';
    }
    if(empty($post['role']) || !in_array($post['role'], $possibleRole)) {
      $error[] = 'Précisez la catégorie, svp';
    }

    // ACTION!
    if(count($error) > 0) {
        $displayErr = true;
        echo '<div class="alert alert-danger" role="alert"></ul>';
        foreach ($error as $err) {
            echo '<li>'. $err . '</li>';
        }
      echo '</ul></div>';
    } else {
        // get authors id of logged user
        $authorId = $_SESSION['user']['id'];

        $sql = $db->prepare('INSERT INTO recipes (role, title, content, link, ingredients, author_id, date_publish) VALUES (:roleRecipe, :titleRecipe, :contentRecipe, :linkRecipe, :ingredientsRecipe, :authorId, NOW()) ');
        $sql->bindValue(':roleRecipe', $post['role']);
        $sql->bindValue(':titleRecipe', $post['title']);
        $sql->bindValue(':contentRecipe', $post['content']);
        $sql->bindValue(':linkRecipe', $post['link']);
        $sql->bindValue(':ingredientsRecipe', $post['ingredients']);
        $sql->bindValue(':authorId', $authorId);

        if($sql->execute()) {
            $formValid = true;
            echo '<div class="alert alert-success" role="alert">Cette recette a été bien ajoutée.</div>';
        }
        else {
            die(print_r($sql->errorInfo()));
        }
    } // end of count($error) > 0
} // end of !empty($_POST)

?>
