<?php include_once 'functions.php'; logged_only(); ?>
<div class="row">
    <div class="col-xs-12 col-sm-8">
        <div id="msg-container">
            <?php
                $allMsgs = checkNotReadMsg();
                foreach ($allMsgs as $key => $msg) {
                    showMessages($msg);
                    echo '<hr>';
                }
            ?>
        </div>
    </div>

    <div class="col-xs-12 col-sm-4">
        <div id="msgRead"></div>
    </div>
</div>


<?php
if (empty($allMsgs)) {
    echo '<p class="noresult-msg">Vouz n\'avez pas de messages</p>';
}
?>
