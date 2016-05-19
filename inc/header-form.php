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
    $searchResult = $searchKeyword->fetchAll(PDO::FETCH_ASSOC);
    foreach ($searchResult as $article) {
        showArticles($article);
    }



}
//
//
// if(!empty($_POST)) {
//   foreach ($_POST as $key => $value) {
//     $post[$key] = trim(strip_tags($value));
//   }
//   if (strlen($post['firstname']) < 3 || strlen($post['firstname']) > 12) {
//     $error[] = 'Votre prénom doit comporter entre 3 et 12 caractères';
//   }
//   if (strlen($post['lastname']) < 2 || strlen($post['lastname']) > 12) {
//     $error[] = 'Votre nom doit comporter entre 2 et 12 caractères';
//   }
//   if (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
//     $error[] = 'Votre email n\'est pas valide';
//   }
//   if (empty($post['message'])) {
//     $error[] = 'Le contenu ne peut pas etre vide';
//   }
//
//   if(count($error) > 0){
//       echo '<ul>';
//           foreach ($error as $value) {
//             echo '<li>' . $value . '</li>';
//           }
//       echo '</ul>';
//   }
//   else {
//
//
//       if($success) {
//           echo "success";
//       } else {
//           echo '<ul>';
//           foreach ($error as $value) {
//             echo '<li>' . $value . '</li>';
//           }
//           echo '</ul>';
//       }
//   }
// }

?>
