<?php
$post = [];
$errors = [];

if(!empty($_POST) && isset($_POST['logok'])) {
    foreach ($_POST as $key => $value) {
        $post[$key] = trim(strip_tags($value));
    }

    var_dump($post);
}
 ?>
