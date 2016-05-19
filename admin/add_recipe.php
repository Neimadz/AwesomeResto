<?php     // Page add_recipe

$post = array();
$error = array();
$displayErr = false;
$formValid = true;

if(!empty($_POST)) {
    foreach($_POST as $key => $value){
      $post[$key] = trim(strip_tags($value));
    }

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
    if(count($error) > 0) {
      $displayErr = true;
      } else {
        $formValid = true;

require_once '../inc/connect.php';

      $sql = $db->prepare('INSERT INTO recipes (role, title, content, link, ingredients, date_publish) VALUES (:roleRecipe, :titleRecipe, :contentRecipe, :linkRecipe, :ingredientsRecipe, NOW()) ');
      $sql->bindValue(':roleRecipe', $post['role'], PDO::PARAM_STR);
      $sql->bindValue(':titleRecipe', $post['title'], PDO::PARAM_STR);
      $sql->bindValue(':contentRecipe', $post['content'], PDO::PARAM_STR);
      $sql->bindValue(':linkRecipe', $post['link'], PDO::PARAM_STR);
      $sql->bindValue(':ingredientsRecipe', $post['ingredients'], PDO::PARAM_STR);

      if($sql->execute()) {
        echo '<h1><center>Tout est bon, la recette est bien ajoutée';
        // echo'<br><a href="  .php?">Retour Accueil';
        }
        else {
          die(print_r($sql->errorInfo()));
        }  
      }
}  else {
?>
          <p><strong>- Ajouter une recette -</strong></p>

      <form method="POST" action="add_recipe.php">

        <label for="role">Catégorie :</label>
        <form> 
        <SELECT name="role" size="1">        
            <OPTION>Choisir une catégorie :
            <OPTION>entrance
            <OPTION>dish
            <OPTION>dessert
        </SELECT>        
        <br><br>
        <label for="title">Titre : </label>
        <input type="text" id="title" name="title" placeholder="Entre votre titre ">
        <br><br>
        <label for="content">Description : </label><br>
        <textarea name="content" row="60" cols="50"></textarea> 
        <br><br> 
        <label for="link">Votre image : </label>
        <input type="text" id="link" name="link"  placeholder="Insérez votre image ici">
        <br><br>
        <label for="ingredients">Vos ingrédients : </label><br>
        <textarea name="ingredients" row="60" cols="50"></textarea>        
        <br><br> 

        <a><input type="submit" value="Ajouter la recette"></a>        
      </form>
 <?php
 }
 ?>    

