<h1>Ajouter une recette</h1>

<form id="add-recipe-form" method="POST">
    <div class="form-group">
        <label for="role">Catégorie :</label>
        <select name="role" id="add-role" class="form-control" size="1">
            <option>Choisir une catégorie :</option>
            <option value="entrance">Entrée</option>
            <option value="dish">Plat</option>
            <option value="dessert">Dessert</option>
        </select>
    </div>

    <div class="form-group">
        <label for="title">Titre : </label>
        <input type="text" id="add-title" class="form-control" name="title" placeholder="Entrez votre titre ">
    </div>

    <div class="form-group">
        <label for="content">Description : </label><br>
        <textarea name="content" id="add-content" class="form-control" row="60" cols="50"></textarea>
    </div>

    <div class="form-group">
        <label for="link">Votre image : </label>
        <input type="text" id="add-link" class="form-control" name="link"  placeholder="Insérez votre image ici">
    </div>

    <div class="form-group">
        <label for="ingredients">Vos ingrédients : </label><br>
        <textarea name="ingredients" id="add-ingredients" class="form-control" row="60" cols="50"></textarea>
    </div>

    <input type="submit" class="btn btn-primary" value="Ajouter la recette">

</form>

<div id="add-recipe-msg"></div>
