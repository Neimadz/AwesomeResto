<?php
require_once 'connect.php';
require_once 'functions.php';

$allMsgs = checkNotReadMsg();
if(!empty($allMsgs)){
    if(!empty($_GET) && isset($_GET['msg'])) {
        $id = intval(trim(strip_tags($_GET['msg'])));
        //var_dump($id);
        $getMsg = $db->prepare('UPDATE contact SET is_read = :status WHERE id = :id');
        $getMsg->bindValue(':id', $id);
        $getMsg->bindValue(':status', 'read');
        if($getMsg->execute()) {
            echo 'success';
        }
        else {
            echo 'Message n\'étais pas marqué comme lu';
        }
    }
}
else {
    echo 'Vous n\'avez aucun message';
}

?>
