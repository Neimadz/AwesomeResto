<?php

require_once 'connect.php';

function showArticles($art) {
    echo '<h2 class="article-title">'.$art['title'].'</h2>';
    echo '<p class="article-date">'.$art['date_publish'].'</p>';
    echo '<p class="article-ingr">'.$art['ingredients'].'</p>';
    echo '<p class="article-p">'.$art['content'].'</p>';
    echo '<img src="'.$art['link'].'">';
}

?>
