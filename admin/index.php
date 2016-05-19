<?php
session_start();

require_once 'inc/functions.php';
require_once 'inc/login.php';
include_once 'inc/header.php';

?>
<h1>Identifiez-vous, svp</h1>
<form class="" method="post">
    <input type="hidden" name="logok" value="ok">

    <label for="email">Votre email</label>
    <input type="email" name="email" id="email">
    <br>

    <label for="password">Votre mot de passe</label>
    <input type="password" name="password" id="password">
    <br>

    <label></label>
    <input type="submit" value="Envoyer">
    <br>
</form>

<?php
include_once 'inc/footer.php';
 ?>
