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

$sql = $db->exec("INSERT INTO `recipes` (`id`, `role`, `title`, `content`, `link`, `ingredients`, `date_publish`) VALUES (NULL, 'entrance', 'zaeuio', 'azeiop', 'azeuio', 'azeuio', '2016-05-05 00:00:00')
");