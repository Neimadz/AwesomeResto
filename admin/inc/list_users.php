<?php

$getUsers = $db->prepare('SELECT * FROM users');
$getUsers->execute();
$users = $getUsers->fetchAll(PDO::FETCH_ASSOC);
if(!empty($users)) {
    $count = 1;
    echo '<ul class="list-group">';
    // loop that prints all the users
    foreach ($users as $key => $value) {
        echo '<li class="list-group-item" id="list'. $count . '">' .
             $count . '. '                   .
             $value['firstname']            .
             ' <span class="label '         .
             // condition to check $value role: if role is admin print label-success, else print label-primary
             (($value['role'] == "admin")?"label-success":"label-primary") .
             '">'                           .
             $value['role']                 .
             '<a class="remove-user" href="#" data-id="'         .
             $value['id']                   .
             '"></span><span class="glyphicon glyphicon-remove">'.

             '</span></a></li>';
             $count++;
    }
    echo '</ul>';
}
else {
    echo '<div class="alert alert-info" role="alert">Il n\'y a pas d\'utilisateurs</div>';
}

?>

<div id="removedUserMsg"></div>

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


    <input type="submit" class="btn btn-primary" value="Ajouter la recette">
</form>
