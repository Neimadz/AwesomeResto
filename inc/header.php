<?php
require_once 'inc/functions.php';
require_once 'inc/connect.php';

$img = $db->prepare('SELECT * FROM  img_header WHERE id = 1');
$img->execute();

$image = $img->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Notre resto magnifique</title>
        <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
        <link rel="icon" href="img/favicon.ico" type="image/x-icon">
        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Courgette' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/owl.carousel.css">
        <link rel="stylesheet" href="css/style.css">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <nav class="navbar">
          <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="index.php">Ristorante</a>
            </div>

            <form id="header_search" class="navbar-form navbar-right" role="search" method="GET">
              <div class="form-group">
                <input type="text" id="header_keyword" class="form-control" name="header_keyword" placeholder="Search">
                <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
              </div>

            </form>


            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav navbar-right">
                <li><a href="index.php">Accueil<span class="sr-only">(current)</span></a></li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Recettes<span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="entrances.php">Entrées</a></li>

                    <li role="separator" class="divider"></li>
                    <li><a href="dishs.php">Plats</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="desserts.php">Desserts</a></li>
                  </ul>
                </li>
                <li><a href="contact.php">Contactez-nous</a></li>
              </ul>


            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>

            <header>
                <div class="owl-carousel">

                    <div class="item carousel-item-1"><img src="<?php $_SERVER['HTTP_HOST'];?>/AwesomeResto/img/img_header/<?php echo $image['img1'];?>" alt="food"><h1 class="promo"><i class="fa fa-glass" aria-hidden="true"></i> Pour la Saint-Valentin: coupes de champagne offertes pour tous les couples! </h1></div>
                    <div class="item carousel-item-2"><img src="<?php $_SERVER['HTTP_HOST'];?>/AwesomeResto/img/img_header/<?php echo $image['img2'];?>" alt="food"><h1 class="promo"><i class="fa fa-globe" aria-hidden="true"></i> Tentez de gagner un voyage au coeur de la gastronomie italienne. </h1></div>
                    <div class="item carousel-item-3"><img src="<?php $_SERVER['HTTP_HOST'];?>/AwesomeResto/img/img_header/<?php echo $image['img3'];?>" alt="food"><h1 class="promo"><i class="fa fa-heart" aria-hidden="true"></i> Pour la fête des mères: un dessert à moitié prix pour satisfaire la gourmandise de nos mamans. </h1></div>
                </div>
                <div class="online-reserve">
                    Réserver en ligne <a href="reserve_online.php">Réserver</a>
                </div>
            </header>


            <div id="wrapper">
