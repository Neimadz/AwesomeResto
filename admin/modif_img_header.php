<?php

// modif_img_header

$sql = $db->exec("CREATE TABLE IF NOT EXISTS `img_header` ( 
`id` INT NOT NULL AUTO_INCREMENT , 
`img` VARCHAR(255) NOT NULL , 
`name` VARCHAR(255) NOT NULL , 
PRIMARY KEY (`id`)) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;"
);
if($sql === false){
	die(var_dump($bdd->errorInfo()));
}


$sql=$db->exec("INSERT INTO `img_header` (`id`, `img`, `name`) 
VALUES (NULL, 
'http://www.sudarchitectes.com/medias/projets_diapo/restaurant-christian-tetedoie-lyon-antiquaille-france_46-2T1.jpg', 
'img_header8')"
);

