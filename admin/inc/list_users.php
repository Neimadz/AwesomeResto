<div id="user-container"></div>

<div id="removedUserMsg"></div>
<div id="addedUserMsg"></div>

<h1>Ajouter un nouvel utilisatuer</h1>

<form id="add-user" method="post">
    <div class="form-group">
        <label for="user-add-role">Role :</label>
        <select id="user-add-role" name="user-add-role" class="form-control" size="1">
            <option value="zero">Choisir une catégorie :</option>
            <option value="admin">Admin</option>
            <option value="edit">Editeur</option>
        </select>
    </div>

    <div class="form-group">
        <label for="title">Prénom : </label>
        <input type="text" id="user-add-firstname" name="user-add-firstname" class="form-control" name="title" placeholder="Prenom">
    </div>

    <div class="form-group">
        <label for="title">Nom : </label>
        <input type="text" id="user-add-lastname" name="user-add-lastname" class="form-control" name="title" placeholder="Nom">
    </div>

    <div class="form-group">
        <label for="email">Email : </label><br>
        <input type="email" id="user-add-email" name="user-add-email" class="form-control"></textarea>
    </div>

    <div class="form-group">
        <label for="user-add-password">Mot de passe: </label>
        <input type="password" id="user-add-password" name="user-add-password" class="form-control">
    </div>


    <input type="submit" class="btn btn-primary" value="Ajouter user">
</form>
