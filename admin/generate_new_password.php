
<?php if($showFormPassword == true): // Affichage du form de changemnt du mdp ?>
<main>
	<form class="form-horizontal well well-sm" method="post">
	        <input type="hidden" name="action" value="updatePassword">
	    <div class="form-group">
	        <label class="col md-4 control-label" for="new_password">Votre nouveau mot de passe : </label>
	        <div clas="col-md-4">
	            <input type="password" name="new_password" id="new_password" class="form-control">
	        </div>
	    </div>
	    <div class="form-group">
	        <label class="col-md-4 control-label" for="new_password_conf">Confirmation du nouveau mot de passe : </label>
	        <div class="col-md-4">
	            <input type="password" name="new_password_conf" id="new_password_conf" class="form-control">
	        </div>
	    </div>
	    <div class="form-group">
	        <div class="col-md-4 col-md-offset-4">
	            <button type="submit" class="btn btn-default">Mettre à jour votre nouveau mot de passe</button>
	        </div>
	    </div>
	</form>
<?php endif; ?>	
</main
