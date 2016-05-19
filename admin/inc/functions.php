<?php

function showMessages($msg) {
    echo '<div class="admin-msg">';
    echo '<h3 class="msg-author">'.$msg[''].'</h3>';
    echo '<p class="msg-title">'.$msg[''].'</p>';
    echo '<p class="msg-content">'.$msg[''].'</p>';
    echo '</div>';

}

?>
