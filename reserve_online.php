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
                    <label for="how_many" class="col-sm-2 control-label"><i class="fa fa-users" aria-hidden="true"></i></label>                    
                    <div class="col-sm-10">
                        <select id="how_many" name="how_many">
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                        <option>6</option>
                        <option>7</option>
                        <option>8</option>
                        <option>9</option>
                        <option>10</option>
                        <option>11</option>
                        <option>12</option>
                        <option>13</option>
                        <option>14</option>
                        <option>15</option>
                        <select> 
                    </div>
                </div>

                <div class="form-group">
                    <label for="num" class="col-sm-2 control-label"><i class="fa fa-phone" aria-hidden="true"></i></label>
                    <div class="col-sm-10">
                        <input type="num" class="form-control" id="num" name="num" placeholder="Votre numéro de téléphone">  
                    </div>
                </div>

                <div class="form-group">
                    <label for="date" class="col-sm-2 control-label"><i class="fa fa-calendar" aria-hidden="true"></i></label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="date" name="date">  
                    </div>
                </div>

                <div class="form-group">
                    <label for="hour" class="col-sm-2 control-label"><i class="fa fa-clock-o" aria-hidden="true"></i></label>
                    <div class="col-sm-10">
                        <input type="time" class="form-control" id="hour" name="hour">  
                    </div>
                </div>

                <div class="form-group">
                    <label for="message" class="col-sm-2 control-label"><i class="fa fa-commenting-o" aria-hidden="true"></i></label>
                    <div class="col-sm-10">
                        <textarea id="message" class="form-control" rows="5" name="message" placeholder="Autre chose à préciser?"></textarea>     
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