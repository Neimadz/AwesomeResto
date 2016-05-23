<?php
require_once 'connect.php';

function showMessages($msg) {
    if ($msg['is_read'] == 'read') {
        echo '<div class="admin-msg msg-read"';
    }
    else {
        echo '<div class="admin-msg msg-not-read"';
    }
    echo 'id="message-div-'.$msg['id'].'">';
    echo '<h3 class="msg-author">'.$msg['name'].'</h3>';
    echo '<p class="msg-email">'.$msg['email'].'</p>';
    echo '<p class="msg-content">'.$msg['message'].'</p>';
    echo '<a class="mark-as-read" href="#" data-message-id="'.$msg['id'].'">Marquer comme lu</a>';
    echo '</div>';
}

function checkNotReadMsg() {
    global $db;
    $showMessages = $db->prepare('SELECT * FROM contact');
    // $showMessages->bindValue(':role', 'not_read');
    $showMessages->execute();
    return $showMessages->fetchAll(PDO::FETCH_ASSOC);
}
