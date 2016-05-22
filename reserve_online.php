<?php require_once 'inc/header.php';
?>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h1 class="reserve-online text-center">Réservez en ligne</h1>
            <img src="http://www.bistrolenchanteur.com/assets/img/feature_image_reservation.jpg" width="600" height="120"  alt="Resa img" /><br><br>
            <form id="reserve-form" class="form-horizontal" role="form" method="post">

                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Nom</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Votre nom">
                    </div>
                </div>

                <div class="form-group">
                    <label for="firstname" class="col-sm-2 control-label">Prénom</label>
                    <div class="col-sm-10">
                        <input type="firstname" class="form-control" id="firstname" name="firstname" placeholder="Votre prénom">  
                    </div>
                </div>

                <div class="form-group">
                    <label for="how_many" class="col-sm-2 control-label">Nombre de personnes</label>
                    <div class="col-sm-10">
                        <input type="how_many" class="form-control" id="hom_many" name="how_many" placeholder="Combien de personnes?">  
                    </div>
                </div>

                <div class="form-group">
                    <label for="num" class="col-sm-2 control-label">Votre numéro de téléphone</label>
                    <div class="col-sm-10">
                        <input type="num" class="form-control" id="num" name="num" placeholder="Votre numéro de téléphone">  
                    </div>
                </div>

                <div class="form-group">
                    <label for="date" class="col-sm-2 control-label">Votre date</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="date" name="date">  
                    </div>
                </div>

                <div class="form-group">
                    <label for="hour" class="col-sm-2 control-label">Votre heure</label>
                    <div class="col-sm-10">
                        <input type="time" class="form-control" id="hour" name="hour">  
                    </div>
                </div>

                <div class="form-group">
                    <label for="message" class="col-sm-2 control-label">Autre chose ?</label>
                    <div class="col-sm-10">
                        <textarea id="message" class="form-control" rows="5" name="message"></textarea>     
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        <input id="submit" name="submit" type="submit" value="Réserver" class="btn btn-primary">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                    </div>
                </div>
            </form>
        </div> 
    </div>
</div> 


<?php include_once 'inc/footer.php'; ?>  