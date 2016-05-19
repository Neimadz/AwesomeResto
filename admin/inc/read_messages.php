<div id="msgRead"></div>
<?php
//require_once 'connect.php';

$allMsgs = checkNotReadMsg();
foreach ($allMsgs as $key => $msg) {
    showMessages($msg);
}

if (empty($allMsgs)) {
    echo 'Vouz n\'avez pas de messages';
}
?>
