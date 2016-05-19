<?php     // Page add_recipe

$post = array();
$error = array();
$displayErr = false;
$formValid = false;
$possibleRole = ['entrance', 'dish', 'dessert'];

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
    if(empty($post['role']) || !in_array($post['role'], $possibleRole)) {
      $error[] = 'Présicez la catégorie, svp';
    }
    if(count($error) > 0) {
      $displayErr = true;
    } else {

      //require_once '../inc/connect.php';

        $sql = $db->prepare('INSERT INTO recipes (role, title, content, link, ingredients, date_publish) VALUES (:roleRecipe, :titleRecipe, :contentRecipe, :linkRecipe, :ingredientsRecipe, NOW()) ');
        $sql->bindValue(':roleRecipe', $post['role']);
        $sql->bindValue(':titleRecipe', $post['title']);
        $sql->bindValue(':contentRecipe', $post['content']);
        $sql->bindValue(':linkRecipe', $post['link']);
        $sql->bindValue(':ingredientsRecipe', $post['ingredients']);

        if($sql->execute()) {
            $formValid = true;
        }
        else {
              die(print_r($sql->errorInfo()));
        }
    }
}

?>

<h1>Ajouter une recette</h1>

<form method="POST">

      <label for="role">Catégorie :</label>

      <select name="role" size="1">
        <option>Choisir une catégorie :</option>
        <option value="entrance">Entrée</option>
        <option value="dish">Plat</option>
        <option value="dessert">Dessert</option>
      </select>
      <br><br>

      <label for="title">Titre : </label>
      <input type="text" id="title" name="title" placeholder="Entrez votre titre ">
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

      <input type="submit" value="Ajouter la recette">
</form>

<?php
if($displayErr) {
    foreach ($error as $err) {
        echo $err;
    }
}
if($formValid) {
    echo '<h1><center>Tout est bon, la recette est bien ajoutée</center></h1>';
}
?>
