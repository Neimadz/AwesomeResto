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

function logged_only(){
    if (session_status() == PHP_SESSION_NONE) {
            session_start(); 
        }
    if (!isset($_SESSION['user'])) {
        echo "<div class='alert alert-danger'>Vous n'avez pas le droit d'accéder a cette page !</div>";
      /*  header('Location: ../index.php');*/
        exit();
    }
}
function selectCategory($role){
    global $db; // Va chercher la variable $db qui se trouve hors de la fonction

    // Prépare et execute la requète SQL
    $debut = $db->prepare('SELECT * FROM recipes WHERE role = :assoc ORDER BY date_publish ASC');
    $debut->bindValue(':assoc', $role);
    $debut->execute();

    // Retourne tous les roles de la table "recipes" indiqué dans la fonction sous forme de array()
    return $debut->fetchAll(PDO::FETCH_ASSOC);
}
function cutString($string, $start, $length, $endStr = '[&hellip]'){
    // si la taille de la chaine est inférieure ou égale à celle
    // attendue on la retourne telle qu'elle
    if( strlen( $string ) <= $length ) return $string;
    // autrement on continue

    // permet de couper la phrase aux caractères définis tout
    // en prenant en compte la taille de votre $endStr et en
    // re-précisant l'encodage du contenu récupéré
    $str = mb_substr( $string, $start, $length - strlen( $endStr ) + 1, 'UTF-8');
    // retourne la chaîne coupée avant la dernière espace rencontrée
    // à laquelle s'ajoute notre $endStr
    return substr( $str, 0, strrpos( $str,' ') ).$endStr;
}
function verif($conditions, $verification){
    if(!preg_match($conditions, $verification)) {
        return true;
    }
    else{
        return false;
    }
}
?>
