<?php     // Page add_recipe

$post = array();
$error = array();
$displayErr = false;
$formaValid = true;


<body>
          <p><strong>- Ajouter une recette -</strong></p>

      <form method="POST" action="add_recipe.php">

        <label for="role">Catégorie :</label>
        <input type="text" id="role" name="role" 
        <SELECT name="role" size="1">
            <OPTION>entrance
            <OPTION>dish
            <OPTION>dessert
        </SELECT>  
        <br>

        <label for="title">Titre :</label>
        <input type="text" id="title" name="title" placeholder="Entre votre titre ">
        <br> 

        <label for="content">Description :</label>
        <input type="text" id="content" name="content"> 
        <br>        

          <label for="link">Votre image :</label>
          <input type="text" id="link" name="link"  placeholder="Insérez votre url ici">
          <br>

          <label for="content">Vos ingrédients : </label><br>
          <textarea name="content" row="40" cols="70"></textarea>        
          <br>          

          <a><input type="submit" value="Ajouter la recette"></a>        
      </form>

