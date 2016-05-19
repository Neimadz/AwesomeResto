<?php 

$db = new PDO('mysql:host=localhost;dbname=restaurant;charset=utf8', 'root', ''); 

$sql = $db->exec("CREATE TABLE IF NOT EXISTS `users` ( 
	`id` INT NOT NULL AUTO_INCREMENT , 
	`firstname` VARCHAR(255) NOT NULL , 
	`lastname` VARCHAR(255) NOT NULL , 
	`role` ENUM('admin','edit') NOT NULL , 
	`email` VARCHAR(255) NOT NULL , 
	`password` VARCHAR(255) NOT NULL , 
	`date_registration` DATETIME NOT NULL , 
	PRIMARY KEY (`id`), UNIQUE (`email`)) 
	ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;");
if($sql === false){	
	die(var_dump($bdd->errorInfo()));
}

$sql = $db->exec("CREATE TABLE IF NOT EXISTS`recipes` ( 
	`id` INT NOT NULL AUTO_INCREMENT , 
	`role` ENUM('entrance','dish','dessert') NOT NULL , 
	`title` VARCHAR(255) NOT NULL , 
	`content` VARCHAR(255) NOT NULL , 
	`link` VARCHAR(255) NOT NULL , 
	`ingredients` VARCHAR(255) NOT NULL , 
	`date_publish` DATETIME NOT NULL , 
	PRIMARY KEY (`id`)) 
	ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;");  
if($sql === false){	
	die(var_dump($bdd->errorInfo()));
}

// Entrée 1    Griddled vegetables & feta with tabbouleh     recette 1

$sql = $db->exec("INSERT INTO `recipes` (`id`, `role`, `title`, `content`, `link`, `ingredients`, `date_publish`) 
	VALUES (NULL,
	'entrance',
	'Griddled vegetables & feta with tabbouleh',
	'“This is a great meat-free recipe. Barbecuing a whole block of feta is a really interesting way to use it – you get a wicked texture contrast between the beautifully golden outside and the soft, creamy centre. The smoky flavour adds a subtle but beautiful twist to this delicious summery dish. ”
	'http://cdn.jamieoliver.com/recipe-database/xtra_med/BWh5WOT0420A1wV_XQz54o.jpg',
	'½	a bunch of	fresh oregano
½	a bunch of	fresh flat-leaf parsley
2	red onions
1	large	aubergine
150	g	feta cheese
olive oil
3	courgettes (a mixture of yellow and green)
2	handfuls of	mixed tomatoes
1	bulb of	garlic
50	g	shelled pistachios
2	tablespoons	runny honey
extra virgin olive oil
TABBOULEH
250	g	cracked wheat
1	bunch of	fresh mint
1	big bunch of	fresh flat-leaf parsley
½	a	cucumber
1	lemon
	'2016-19-05 11:20:5000')
");

$sql = $db->exec("INSERT INTO `recipes` (`id`, `role`, `title`, `content`, `link`, `ingredients`, `date_publish`) 
	VALUES (NULL,
	'entrance',
	'Griddled vegetables & feta with tabbouleh',
	'',
	'',
	'',
	'2016-19-05 11:20:5000')
");

$sql = $db->exec("INSERT INTO `recipes` (`id`, `role`, `title`, `content`, `link`, `ingredients`, `date_publish`) 
	VALUES (NULL,
	'entrance',
	'Griddled vegetables & feta with tabbouleh',
	'',
	'',
	'',
	'2016-19-05 11:20:5000')
");

$sql = $db->exec("INSERT INTO `recipes` (`id`, `role`, `title`, `content`, `link`, `ingredients`, `date_publish`) 
	VALUES (NULL,
	'entrance',
	'Griddled vegetables & feta with tabbouleh',
	'',
	'',
	'',
	'2016-19-05 11:20:5000')
");

$sql = $db->exec("INSERT INTO `recipes` (`id`, `role`, `title`, `content`, `link`, `ingredients`, `date_publish`) 
	VALUES (NULL,
	'entrance',
	'Griddled vegetables & feta with tabbouleh',
	'',
	'',
	'',
	'2016-19-05 11:20:5000')
");