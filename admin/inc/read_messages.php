
<div class="row">
    <div class="col-xs-12 col-sm-8">
        <div id="msg-container">
            <?php
                $allMsgs = checkNotReadMsg();
                foreach ($allMsgs as $key => $msg) {
                    showMessages($msg);
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
