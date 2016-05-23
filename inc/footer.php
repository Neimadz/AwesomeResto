            </div> <!-- end of #wrapper-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/owl.carousel.min.js"></script>
        <script src="js/contact-form-ajax.js"></script>
        <script src="js/script.js"></script>
    </body>
    	<footer>
<?php
    $adr = $db->prepare('SELECT adress FROM  img_header WHERE id = 1');
    $adr->execute();
    $adress = $adr->fetch(PDO::FETCH_ASSOC);
?>
		<h4>Ristorante !</h4>
		<p> <?php echo $adress['adress'];?> </p>
        <a href="page_infos.php">Plus d'infos</a>
	</footer>
</html>
