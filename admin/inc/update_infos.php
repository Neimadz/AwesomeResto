<?php include_once 'functions.php';
logged_only(); ?>

<!-- formulaire changement à remplir pour changer coordonées user -->
	<p class="update-info-title"> Mettez vos nouvelles photos et adresse! <p>
  <form method="POST" class="pure-form" name="update_infos" id="update_infos">
  		<div class="form-group">
    		<label for="exampleInputFile"> Chargez votre image ici </label>
    		<input name="img1" type="file" id="img1">
    		<p class="help-block"> image 1 carousel <br></p>
  		</div>
  		<div class="form-group">
    		<label for="exampleInputFile"> Chargez votre image ici </label>
    		<input name="img2" type="file" id="img2">
    		<p class="help-block"> image 2 carousel <br></p>
  		</div>
  		<div class="form-group">
    		<label for="exampleInputFile"> Chargez votre image ici</label>
    		<input name="img3" type="file" id="img3">
    		<p class="help-block"> image 3 carousel <br></p>
  		</div>
  		<input name="adress" type="text" class="form-control" id="adress" placeholder="Nouvelle adresse ici">

  		<button type="submit" class="btn btn-default">Submit</button>
	</form>
    <div id="infosUpdate"></div>