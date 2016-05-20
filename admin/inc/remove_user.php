<?php
require_once 'connect.php';

$post = [];
$errors = [];
if(!empty($_POST)) {
    foreach ($_POST as $key => $value) {
        $post[$key] = intval(trim(strip_tags($value)));
    }
    if(isset($post['id'])) {
        $id = $post['id'];
        $deleteUser = $db->prepare('DELETE FROM users WHERE id = :thisId');
        $deleteUser->bindValue(':thisId', $id);
        if($deleteUser->execute()) {
            echo '<div class="alert alert-success" role="alert">Cet user a été bien supprimé</div>';
        }
    }
    else {
        echo '<div class="alert alert-danger" role="alert">Impossible de supprimer cet utilisateur</div>';
    }
}
?>
