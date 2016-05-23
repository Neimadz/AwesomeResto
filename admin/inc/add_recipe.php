<?php  
include_once 'functions.php';
require_once 'connect.php';
logged_only();

$post = []; // Le tableau qui contiendra les données de mon formulaire nettoyées
$error = []; // J'instancie mon tableau d'erreurs
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

if(!empty($_POST)){ // On vérifie que le formulaire est soumis

    foreach($_POST as $key => $value){ // On nettoie un peu :-)
        $post[$key] = trim(strip_tags($value));
    }
    if(verif(("#^.{5,140}$#"), $post['title'])){
      $errors[] = 'Le titre de la recette doit comporter entre 5 et 140 cractères';
    }
    if(verif(("#^.{20,}$#"), $post['content'])){
      $errors[] = 'Le contenu doit faire au moins 20 caractères';
    }
    if(empty($post['ingredients'])) {
      $errors[] = 'La listes d\'ingrédients doit être complète';
    }
    if(empty($post['role']) || !in_array($post['role'], $possibleRole)) {
      $errors['ok'] = 'Précisez la catégorie, svp';
    }
    if(count($error) > 0){
        $showErrors = true;
    }
    else {
        $requete = $db->prepare('INSERT INTO recipes (author_id, title, role, content, link, ingredients, date_publish) VALUES(:myId, :myTitle, :role, :myContent, :myLink, :myIngredients, NOW())');
        $requete->bindValue(':myId', $_SESSION['user']['id']);
        $requete->bindValue(':myTitle', $post['title']);
        $requete->bindValue(':role', $post['role']);
        $requete->bindValue(':myContent', $post['content']);
        $requete->bindValue(':myLink', $imageFinale);
        $requete->bindValue(':myIngredients', $post['ingredients']);

        if($requete->execute()){ // Si la requete s'execute correctement
            $success = true;
        }

    }
}
?>
<?php 
    if(isset($success) && $success == true){
        echo '<p style="color:green">Well done !</p>';
    }
    if(isset($showErrors) && $showErrors == true){
        // Afficher mes erreurs
        echo '<div class="alert alert-danger"><ul>';
        foreach($error as $err){
            echo '<li>'.$err.'</li>';
        }
        echo '</ul></div>';
        // Moins sexy, mais fonctionnel :
        //echo implode('<br>', $error);
    }
?>
<h1>Ajouter une recette</h1>

<form id="add-recipe-form" enctype="multipart/form-data" method="POST">
    <div class="form-group">
        <label for="role">Catégorie :</label>
        <select name="role" id="add-role" class="form-control" size="1">
            <option>Choisir une catégorie :</option>
            <option value="entrance">Entrée</option>
            <option value="dish">Plat</option>
            <option value="dessert">Dessert</option>
        </select>
    </div>

    <div class="form-group">
        <label for="title">Titre : </label>
        <input type="text" id="add-title" class="form-control" name="title" placeholder="Entrez votre titre ">
    </div>

    <div class="form-group">
        <label for="content">Description : </label><br>
        <textarea name="content" id="add-content" class="form-control" row="60" cols="50"></textarea>
    </div>

    <div class="form-group">
        <label for="link">Votre image : </label>
        <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $maxSize; ?>">
        <input type="file" id="add-link" class="form-control" name="image"  placeholder="Insérez votre image ici">
    </div>

    <div class="form-group">
        <label for="ingredients">Vos ingrédients : </label><br>
        <textarea name="ingredients" id="add-ingredients" class="form-control" row="60" cols="50"></textarea>
    </div>

    <input type="submit" class="btn btn-primary" value="Ajouter la recette">

</form>

<div id="add-recipe-msg"></div>
