<?php
session_start();
require_once 'connect.php'; // dosn't work without
include_once 'functions.php';

$post = array();
$error = array();
$displayErr = false; // show errors
$formValid = false; // form was filled well and data was inserted to the db
$maxSize = 500000; // Taille maxi de mes fichiers (en octets)
$folder = '../img/'; // Dossier de destination de mes fichiers
$possibleRole = ['entrance', 'dish', 'dessert']; // acceptable values

if(!empty($_FILES) && isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK && $_FILES['image']['size'] < $maxSize){
    
    $fileName = $_FILES['image']['name']; // Nom de mon image
    $fileTemp = $_FILES['image']['tmp_name']; // Image temporaire

    $file = new finfo(); // Classe FileInfo
    $mimeType = $file->file($_FILES['image']['tmp_name'], FILEINFO_MIME_TYPE); // Retourne le VRAI mimeType
    $mimeTypeAllowed = ['image/jpg', 'image/jpeg', 'image/png','image/gif']; // Les mime types autorisés

    // Permet de vérifier que le mime type est bien autorisé
    if(in_array($mimeType, $mimeTypeAllowed)){
        /*
         * explode() permet de séparer une chaine de caractère en un tableau
         * Ici, on aura donc : 
         *      $newFileName = array(
                    0 => 'nom-de-mon-fichier', 
                    1 => 'jpg'
                );
         */
        $newFileName = explode('.', $fileName);
        $fileExtension = end($newFileName); // Récupère l'extension du fichier

        $finalFileName = 'user-'.time().$fileExtension; // Le nom du fichier sera donc : user-1463058435.jpg (time() retourne un timestamp à la seconde). Cela permet de sécuriser l'upload de fichier


        if(move_uploaded_file($fileTemp, $folder.$finalFileName)){
            // Ici je suis sur que mon image est au bon endroit
            $imageFinale = $folder.$finalFileName;
        }
        else {
            $imageFinale = 'img/default-avatar.jpg'; // Permet d'avoir une image par défaut si l'upload ne s'est pas bien déroulé... Evidemment, il faut que l'image existe :-)
        }
    }
    else {
        $error[] = 'Le mime type est interdit';
    }

}
else {
    $error[] = 'L\'image est trop lourde';
}


if(!empty($_POST)) {
    // clean user input
    foreach($_POST as $key => $value){
      $post[$key] = trim(strip_tags($value));
    }
    // verification
    if(verif(("#^.{5,140}$#"), $post['title'])){
      $errors[] = 'Le titre de la recette doit comporter entre 5 et 140 cractères';
    }
    if(verif(("#^.{20,}$#"), $post['content'])){
      $errors[] = 'Le contenu doit faire au moins 20 caractères';
    }
    if(empty($post['ingredients'])) {
      $error[] = 'La listes d\'ingrédients doit être complète';
    }
    if(empty($post['role']) || !in_array($post['role'], $possibleRole)) {
      $error[] = 'Précisez la catégorie, svp';
    }

    // ACTION!
    if(count($error) > 0) {
        $displayErr = true;
        echo '<div class="alert alert-danger" role="alert"></ul>';
        foreach ($error as $err) {
            echo '<li>'. $err . '</li>';
        }
        echo '</ul></div>';
    } else {
        // get authors id of logged user
        $authorId = $_SESSION['user']['id'];

        $sql = $db->prepare('INSERT INTO recipes (role, title, content, link, ingredients, author_id, date_publish) VALUES (:roleRecipe, :titleRecipe, :contentRecipe, :linkRecipe, :ingredientsRecipe, :authorId, NOW()) ');
        $sql->bindValue(':roleRecipe', $post['role']);
        $sql->bindValue(':titleRecipe', $post['title']);
        $sql->bindValue(':contentRecipe', $post['content']);
        $sql->bindValue(':linkRecipe', $imageFinale);
        $sql->bindValue(':ingredientsRecipe', $post['ingredients']);
        $sql->bindValue(':authorId', $authorId);

        if($sql->execute()) {
            $formValid = true;
            echo '<div class="alert alert-success" role="alert">Cette recette a été bien ajoutée.</div>';
        }
        else {
            die(print_r($sql->errorInfo()));
        }
    } // end of count($error) > 0
} // end of !empty($_POST)

?>
