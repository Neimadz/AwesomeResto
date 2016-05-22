<?php
require_once 'connect.php';

function showMessages($msg) {
    echo '<div class="admin-msg" data-id="'.$msg['id'].'">';
    echo '<h3 class="msg-author">'.$msg['name'].'</h3>';
    echo '<p class="msg-email">'.$msg['email'].'</p>';
    echo '<p class="msg-content">'.$msg['message'].'</p>';
    echo '<form class="ajax-read-msg" method="get">';
    echo '<input type="hidden" class="ajax-read-msg-id" name="msg" value="'.$msg['id'].'">';
    echo '<input type="submit" value="Marquer comme lu">';
    echo '</form>';
    echo '</div>';
}

function checkNotReadMsg() {
    global $db;
    $showMessages = $db->prepare('SELECT * FROM contact WHERE is_read = :role');
    $showMessages->bindValue(':role', 'not_read');
    $showMessages->execute();
    return $showMessages->fetchAll(PDO::FETCH_ASSOC);
}

/************SIMPLIFICATION DES PREG_MATCH*********/

/*function verif($conditions, $verification){
    if(!preg_match($conditions, $verification)) {
        return true;
    }
    else{
        return false;
    }
}*/
