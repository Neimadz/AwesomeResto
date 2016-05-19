<?php
session_start();

include_once 'inc/header.php';

if (isset($_SESSION['user']) && $_SESSION['user']['role'] == 'edit') {
?>
<div>
    <ul id="myTabsEdit" class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#modify-article-edit" aria-controls="modify-article-edit" role="tab" data-toggle="tab">Ajouter un article</a></li>
        <li role="presentation"><a href="#add-article-edit" aria-controls="add-article-edit" role="tab" data-toggle="tab">Modifier un article</a></li>
    </ul>

    <div class="tab-content">
       <div role="tabpanel" class="tab-pane active" id="modify-article-edit">
           <?php require_once 'add_recipe.php'; ?>
       </div>

       <div role="tabpanel" class="tab-pane" id="add-article-edit">

       </div>

     </div>
</div>



<?php
} // end of role edit
if(isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin') {
?>

<div>
    <ul id="myTabs" class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#modify-article" aria-controls="modify-article" role="tab" data-toggle="tab">Ajouter un article</a></li>
        <li role="presentation"><a href="#add-article" aria-controls="add-article" role="tab" data-toggle="tab">Modifier un article</a></li>
        <li role="presentation"><a href="#modify-header" aria-controls="modify-header" role="tab" data-toggle="tab">Modifier header</a></li>
        <li role="presentation"><a href="#read-messages" aria-controls="read-messages" role="tab" data-toggle="tab">Lire les messages</a></li>
    </ul>

    <div class="tab-content">
        <div role="tabpanel" class="tab-pane" id="modify-article">
            <?php require_once 'add_recipe.php'; ?>
        </div>

        <div role="tabpanel" class="tab-pane active" id="add-article">

        </div>

        <div role="tabpanel" class="tab-pane" id="modify-header">
           <?php require_once 'inc/update_infos.php'; ?>
        </div>

        <div role="tabpanel" class="tab-pane" id="read-messages">
           <?php require_once 'inc/read_messages.php'; ?>
        </div>

    </div>


</div>
<?php
}

include_once 'inc/footer.php';
 ?>
