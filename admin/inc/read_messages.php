<?php
require_once 'connect.php';

$showMessages = $db->prepare('SELECT * FROM contact');
$showMessages->execute();


?>
