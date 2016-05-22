<?php
require_once 'connect.php';
require_once 'functions.php';

$get = [];
$errors = [];

if(!empty($_GET) && isset($_GET['keyword']) ) {
    $get = array_map('strip_tags', $_GET);
    $get = array_map('trim', $get);
    $keyword = $get['keyword'];

    $searchKeyword = $db->prepare('SELECT * FROM recipes WHERE title OR content LIKE :keyword') ;
    $searchKeyword->bindValue(':keyword', '%'.$keyword.'%');
    $searchKeyword->execute();
    if($searchResult = $searchKeyword->fetchAll(PDO::FETCH_ASSOC)) {
        foreach ($searchResult as $article) {
            showSearchResult($article, $keyword);
        }
    }
    else {
        echo '<p class="noresult-search">Désolé, votre demande de <span class="search-recipe-keyword" style="font-weight:bold">' . $keyword . '</span> est introuvable</p>';
    }
}


?>
