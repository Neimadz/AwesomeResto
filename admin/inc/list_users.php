<?php

$getUsers = $db->prepare('SELECT * FROM users');
$getUsers->execute();
$users = $getUsers->fetchAll(PDO::FETCH_ASSOC);
if(!empty($users)) {
    echo '<ul class="list-group">';
    foreach ($users as $key => $value) {
        echo '<li class="list-group-item">'. $value['firstname']. '</li>';
    }
    echo '</ul>';
}
else {
    echo '<div class="alert alert-info" role="alert">Il n\'y a pas d\'utilisateurs</div>';
}

?>
