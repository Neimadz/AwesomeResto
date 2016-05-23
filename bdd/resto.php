<?php 

$upValid = true;
// création d'une data_base restaurant si elle n'existe pas.
$db = new PDO('mysql:host=localhost;charset=utf8', 'root', '');
$db->query("create database if not exists restaurant");
$db->query("use restaurant"); 

/********************************************TABLE USERS ************************************************/

// crée la talbe users si elle n'existe pas.
$sql = $db->exec("CREATE TABLE IF NOT EXISTS `users` (
	`id` INT NOT NULL AUTO_INCREMENT ,
	`firstname` VARCHAR(255) NOT NULL ,
	`lastname` VARCHAR(255) NOT NULL ,
	`role` ENUM('edit', 'admin') NOT NULL ,
	`email` VARCHAR(255) NOT NULL ,
	`password` VARCHAR(255) NOT NULL ,
	`date_registration` DATETIME NOT NULL ,
	PRIMARY KEY (`id`), UNIQUE (`email`))
	ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;"
);
if($sql === false){
	die(var_dump($db->errorInfo()));
}


$password = password_hash( 'test', PASSWORD_DEFAULT);

$users = array(
	[
		'firstname' => 'Captain',
		'lastname'  => 'Obvious',
		'role' 		=> 'admin',
		'email' 	=> 'test@gmail.com',
		'password' 	=>  $password,
		'date_registration' => '2016-05-11 01:02:03',
	],
	[
		'firstname' => 'User',
		'lastname'  => 'User',
		'role' 		=> 'edit',
		'email' 	=> 'user@gmail.com',
		'password' 	=>  $password,
		'date_registration' => '2016-05-18 04:05:06',
	],[
		'firstname' => 'SMogogo',
		'lastname'  => 'gogo',
		'role' 		=> 'edit',
		'email' 	=> 'lol@gmail.com',
		'password' 	=>  $password,
		'date_registration' => '2016-05-18 14:15:06',
	]
);


foreach ($users as $user) {

	$reqEmail = $db->prepare('SELECT email FROM users WHERE email = :email');
	$reqEmail->bindValue(':email', $user['email']);
	$reqEmail->execute();

	if($reqEmail->rowCount() == 0){

		$sql = $db->prepare('INSERT INTO users (firstname, lastname, role, email, password, date_registration) VALUES (:firstname, :lastname, :role, :email, :password, :date_regis)');
		$sql->bindValue(':firstname', $user['firstname']);
		$sql->bindValue(':lastname', $user['lastname']);
		$sql->bindValue(':role', $user['role']);
		$sql->bindValue(':email', $user['email']);
		$sql->bindValue(':password', $user['password']);
		$sql->bindValue(':date_regis', $user['date_registration'], PDO::PARAM_INT);

		$sql->execute();
	}else{
		$upValid = false;
	}
}

/**************************************END TABLE USERS**********************************/


/************************************* TABLE CONTACT ************************************/


// crée la table contact si elle n'existe pas.
$sql = $db->exec("CREATE TABLE IF NOT EXISTS `contact` (
	`id` INT NOT NULL AUTO_INCREMENT ,
	`name` VARCHAR(255) NOT NULL ,
	`email` VARCHAR(255) NOT NULL ,
	`message` VARCHAR(255) NOT NULL ,
	`is_read` ENUM('not_read', 'read') NOT NULL,
	`date_send` DATETIME NOT NULL ,
	PRIMARY KEY (`id`))
	ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;");
if($sql === false){
	die(var_dump($db->errorInfo()));
}

$contacts = array(
	[
		'id'		=> '1',
		'name' 		=> 'machado damien',
		'email' 	=> 'dams_m33@hotmail.fr',
		'message' 	=> 'Salut je recherche a manger des sushi c\'est ici ?',
		'is_read' 	=> 'not_read',
		'date_send' => '2016-05-19 07:17:13',
	],[
		'id'		=> '2',
		'name' 		=> 'ok',
		'email' 	=> 'dams_m33@hotmail.fr',
		'message' 	=> 'Salut je recherche a manger des sushi c\'est ici ?',
		'is_read' 	=> 'not_read',
		'date_send' => '2016-05-19 07:17:13',
	],[
		'id'		=> '3',
		'name' 		=> 'not ok',
		'email' 	=> 'dams_m33@hotmail.fr',
		'message' 	=> 'Salut je recherche a manger des sushi c\'est ici ?',
		'is_read' 	=> 'not_read',
		'date_send' => '2016-05-19 07:17:13',
	],[
		'id'		=> '4',
		'name' 		=> 'personne',
		'email' 	=> 'dams_m33@hotmail.fr',
		'message' 	=> 'Salut je recherche a manger des sushi c\'est ici ?',
		'is_read' 	=> 'not_read',
		'date_send' => '2016-05-19 07:17:13',
	],
);

foreach ($contacts as $contact) {
	$reqId = $db->prepare('SELECT id FROM contact WHERE id = :id');
	$reqId->bindValue(':id', $contact['id'],PDO::PARAM_INT);
	$reqId->execute();

	if($reqId->rowCount() == 0){

		$req = $db->prepare('INSERT INTO contact (id, name, email, message, is_read, date_send) VALUES ( :id, :name, :email, :message, :is_read, :date_send)');
		$req->bindValue(':id', $contact['id'],PDO::PARAM_INT);
		$req->bindValue(':name', $contact['name']);
		$req->bindValue(':email', $contact['email']);
		$req->bindValue(':message', $contact['message']);
		$req->bindValue(':is_read', $contact['is_read']);
		$req->bindValue(':date_send', $contact['date_send'],PDO::PARAM_INT);
		$req->execute();

	} else {
		$upValid = false;
	}
}


/*************************************END TABLE CONTACT************************************/



/*************************************TABLE RECIPES************************************/


//crée la table recipes si elle n'existe pas.
$sql = $db->exec("CREATE TABLE IF NOT EXISTS `recipes` (
	`id` INT NOT NULL AUTO_INCREMENT ,
	`author_id` VARCHAR(255) NOT NULL ,
	`role` ENUM('entrance','dish','dessert') NOT NULL ,
	`title` VARCHAR(255) NOT NULL ,
	`content` VARCHAR(255) NOT NULL ,
	`link` VARCHAR(255) NOT NULL ,
	`ingredients` VARCHAR(255) NOT NULL ,
	`date_publish` DATETIME NOT NULL ,
	PRIMARY KEY (`id`))
	ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;");
if($sql === false){
	die(var_dump($db->errorInfo()));
}

$recipes = array(
	[
		'id' 			=> '1',
		'author_id' 	=> '1',
		'role' 			=> 'entrance',
		'title' 		=> 'Griddled vegetables & feta with tabbouleh',
		'content' 		=> 'This is a great meat-free recipe. Barbecuing a whole block of feta is a really interesting way to use it – you get a wicked texture contrast between the beautifully golden outside and the soft, creamy centre. The smoky flavour adds a subtle but beautiful twist to this delicious summery dish.',
		'link' 			=> 'http://cdn.jamieoliver.com/recipe-database/xtra_med/BWh5WOT0420A1wV_XQz54o.jpg',
		'ingredients' 	=> '½ a bunch of fresh oregano <br> ½ a bunch of fresh flat-leaf parsley <br> 2 red onions <br> 1 large aubergine <br> 150g	feta cheeseolive oil <br> 3 courgettes (a mixture of yellow and green) <br> 2 handfuls of mixed tomatoes <br> 1 bulb of garlic <br> 50g shelled pistachios 2 tablespoons runny honeyextra virgin olive oilTABBOULEH 250g cracked wheat 1 bunch of fresh mint 1 big bunch of fresh flat-leaf parsley ½ a	cucumber 1 lemon',
		'date_publish' 	=> '2016-05-19 07:17:13',
	],
	[
		'id' 			=> '2',
		'author_id' 	=> '2',
		'role' 			=> 'entrance',
		'title' 		=> 'Tasty fish tacos',
		'content' 		=> '“Just one haddock fillet provides us with a source of seven different essential vitamins and minerals, plus this colourful dish gives us three of our 5-a-day ”',
		'link' 			=> 'http://cdn.jamieoliver.com/recipe-database/oldImages/xtra_med/1596_9_1439906088.jpg',
		'ingredients' 	=> 	'100	g	plain wholemeal flour 2	ripe kiwi fruit 4	spring onions 1	fresh jalapeño or green chilli 1	bunch of	fresh coriander , (30g) 2	limes Tabasco chipotle sauce ¼	of a small	red cabbage	, (150g) 1	tablespoon	red wine vinegar ½ an	orange 1	red or yellow pepper 2 x 120g	fillets of firm white fish, such as haddock, skin on, scaled and pin-boned, from sustainable sources olive oil 2	tablespoons	natural yoghurt',
		'date_publish' 	=> '2016-05-19 08:19:43',
	],	
	[
		'id' 			=> '3',
		'author_id' 	=> '3',
		'role' 			=> 'entrance',
		'title' 		=> 'Delicious winter salad',
		'content' 		=> '“This is really nice served with a simple pasta, with leftover cold meats, in a sandwich or with a simple jacket potato and knob of butter. Any leftovers can be kept in the fridge then served as a really posh coleslaw. ”',
	
		'link' 			=> 'http://cdn.jamieoliver.com/recipe-database/xtra_med/DxuXTkF3qgB9A24KjvZz-a.jpg',
		'ingredients' 	=> 	'½	a	red cabbage ½	a	white cabbage 2	large	carrots 4	spring onions a few	shoots from winter cabbages, such as kale or cavolo nero , optional 300	ml	milk 4	anchovies, from sustainable sources 6	cloves of	garlic 2	tablespoons	white wine vinegar 6	tablespoons	extra virgin olive oil 1	tesapoons	Dijon mustard 1	handful of	mixed seeds, such as poppy, sesame and sunflower ½	a bunch of	fresh mint',
		'date_publish' 	=> '2016-05-19 12:00:50',
	],	
	[
		'id' 			=> '4',
		'author_id' 	=> '1',
		'role' 			=> 'dish',
		'title' 		=> 'Piri piri chicken',
		'content' 		=> '“Crisp, spicy roast chicken, served with piri piri sauce, jalapeño salsa and sweet potato wedges – delicious! ”',
		'link' 			=> 'http://cdn.jamieoliver.com/recipe-database/oldImages/xtra_med/1418_1_1436873314.jpg',
		'ingredients' 	=> '1.3	kg	free-range chicken 3	sprigs of	fresh thyme 4	cloves of	garlic 1 teaspoon	sweet smoked paprika sea salt freshly ground black pepper olive oil 2 red onions 4 ripe tomatoes, mixed colours if possible 6	fresh chillies	, mixed colours if possible red wine vinegar extra virgin olive oil For the sweet potato wedges: 750g	sweet potatoes 1	teaspoon	smoked paprika 2	tablespoons	fine semolina For the jalapeño salsa: 1 x 200g jar of	pickled jalapeños 1	bunch of fresh coriander',
		'date_publish' 	=> '2016-05-20 08:35:07',
	],	
	[
		'id' 			=> '5',
		'author_id' 	=> '2',
		'role' 			=> 'dish',
		'title' 		=> 'Wild boar burgers',
		'content' 		=> '“These might be the best boar burgers ever! ”',
		'link' 			=> 'http://cdn.jamieoliver.com/recipe-database/oldImages/xtra_med/1140_1_1436963553.jpg',
		'ingredients' 	=> '500	g	minced wild boar shoulder	, or belly 1	tbsp	brown sauce	, or to taste Worcestershire sauce	, to taste 1 tbsp	tomato sauce, or to taste 2	shallots, finely chopped 4	burger buns olive oil 2	braeburn apples, or cox\'s apples, sliced at the last minute to serve',
		'date_publish' 	=> '2016-05-20 10:27:35',
	],	
	[
		'id' 			=> '6',
		'author_id' 	=> '3',
		'role' 			=> 'dish',
		'title' 		=> 'Marmexican marinated pork tenderloin',
		'content' 		=> '“A great Friday night recipe with friends. Get everything in the middle of the table and tuck in.”',
		'link' 			=> 'http://cdn.jamieoliver.com/recipe-database/xtra_med/74B9VPWGqs8BGNa_ee3BCy.jpg',
		'ingredients' 	=> '500	g	piece of pork tender loin	, trimmed Olive oil 18	small	corn tortillas lime wedges	, to serve Marinade: Olive oil 2	red onions	, peeled and chopped 6	cloves of	garlic	, peeled and chopped 1/2	large bunch of	coriander	, stalks only (use the leaves for the salsa), finely chopped 2	dried chipotle chillies	, soaked in hot water for 10 minutes, drained, then chopped 1	tsp	ground cumin 1/2	tsp	sweet smoked paprika 3	sprigs of	thyme 2	tbsp	red wine vinegar 1	tbsp	tomato purée 2	tbsp	dark brown sugar 1/2	orange , zest and juice of Rainbow salad: 1	corn on the cob	, soaked for 10 minutes in cold water 1/4	white cabbage	, finely shredded 2	tbsp	white vinegar 6	mixed radishes	, thinly sliced 2	carrots	, speed-peeled into ribbons with a potato peeler 3	little gem hearts	, cut into thin wedges Avocado salsa: 2	ripe avocados	, flesh of, smashed 1	green chilli	, finely chopped (deseeded if you like) 2	spring onions	, finely chopped 1/2	small bunch of	coriander	, leaves picked, roughly chopped 1	lime	, zest and juice of Extra virgin olive oil',
		'date_publish' 	=> '2016-05-20 14:42:02',
	],	
	[
		'id' 			=> '7',
		'author_id' 	=> '1',
		'role' 			=> 'dessert',
		'title' 		=> 'Epic ice cream cake',
		'content' 		=> '“Choose two or three different flavours of your favourite ice cream for this cake – we went for pistachio, strawberry and vanilla. Then when you slice it open all of the amazing layers will be revealed. ”',
		'link' 			=> 'http://cdn.jamieoliver.com/recipe-database/xtra_med/8dhIZVN1qOS9cBVMAjX98l.jpg',
		'ingredients' 	=> '90g	butter, at room temperature, plus extra for greasing 90g	light brown sugar 1	large	free-range egg 30g	ground almonds 60g	self-raising flour 1	tablespoon	cocoa powder ¼	heaped teaspoon	baking powder 30g	dark chocolate (70% cocoa solids) 50ml	milk 1.5litres	ice cream (2-3 flavours)',
		'date_publish' 	=> '2016-05-20 15:10:17',
	],	
	[
		'id' 			=> '8',
		'author_id' 	=> '2',
		'role' 			=> 'dessert',
	
	
	
		'title' 		=> 'Chocolate battenberg',
		'content' 		=> '“This is made with cocoa instead of pink food colouring. Find marzipan in the supermarket baking aisle. Use the cake off-cuts in a trifle. ”',
		'link' 			=> 'http://cdn.jamieoliver.com/recipe-database/xtra_med/6H0HUbu6q3v91gE5eklQf6.jpg',
		'ingredients' 	=> '350g	butter, at room temperature, plus extra for greasing 350g	caster sugar 6	large	free-range eggs ½	tablespoon	vanilla extract 2	tablespoons	milk 285g	self-raising flour 50g	ground almonds 40g	cocoa powder 125g	raspberry jam 450g	marzipan or almond paste',
		'date_publish' 	=> '2016-05-20 16:00:01',
	],	
	[
		'id' 			=> '9',
		'author_id' 	=> '3',
		'role' 			=> 'dessert',
		'title' 		=> 'Chocolate & salted caramel cake',
		'content' 		=> '“You don’t use all the caramel, but it keeps in the fridge for a few days. ”',
		'link' 			=> 'http://cdn.jamieoliver.com/recipe-database/xtra_med/2kUz9apvqo49riq4lB5FBh.jpg',
		'ingredients' 	=> '250g	unsalted butter	, plus extra for greasing 250g	dark chocolate (70% cocoa solids) 150ml	espresso 225g	self-raising flour 250g	golden caster sugar 250	gsoft light brown sugar 2	tablespoons	cocoa powder 100ml	buttermilk 4large	free-range eggs SALTED CARAMEL 200g	sugar 50g	butter 75ml	double cream CHOCOLATE GANACHE 50g	dark chocolate (70% cocoa solids) 50ml	double cream',
		'date_publish' 	=> '2016-05-20 16:30:17',
	]
);

foreach ($recipes as $recipe) {
	$reqId = $db->prepare('SELECT id FROM recipes WHERE id = :id');
	$reqId->bindValue(':id', $recipe['id'],PDO::PARAM_INT);
	$reqId->execute();

	if($reqId->rowCount() == 0){

		$req = $db->prepare('INSERT INTO recipes (id, author_id, role, title, content, link, ingredients, date_publish) VALUES ( :id, :author_id, :role, :title, :content, :link, :ingredients, :date_publish)');
		$req->bindValue(':id', $recipe['id'],PDO::PARAM_INT);
		$req->bindValue(':author_id', $recipe['author_id']);
		$req->bindValue(':role', $recipe['role']);
		$req->bindValue(':title', $recipe['title']);
		$req->bindValue(':content', $recipe['content']);
		$req->bindValue(':link', $recipe['link']);
		$req->bindValue(':ingredients', $recipe['ingredients']);
		$req->bindValue(':date_publish', $recipe['date_publish'],PDO::PARAM_INT);

		$req->execute();

	} else {
		$upValid = false;
	}
}



/*************************************END TABLE RECIPES************************************/

/*************************************TABLE IMG_HEADER***********************************/
// Création de table img_header

$sql = $db->exec("CREATE TABLE IF NOT EXISTS `img_header` ( 
	`id` INT NOT NULL AUTO_INCREMENT , 
	`img1` VARCHAR(255) NOT NULL , 
	`img2` VARCHAR(255) NOT NULL , 
	`img3` VARCHAR(255) NOT NULL , 
	`adress` VARCHAR(255) NOT NULL , 
	PRIMARY KEY (`id`)) 
	ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;"
);if($sql === false){
	die(var_dump($db->errorInfo()));
}

$sql = $db->exec("INSERT INTO `img_header` (
	`id`, 
	`img1`, 
	`img2`, 
	`img3`, 
	`adress`) 
	VALUES (NULL, 
	'img_header1.jpg', 
	'img_header2.jpg', 
	'img_header3.jpg', 
	'Ristorante ! 32 rue rosa bonheur 33000 Bordeaux 0 805 62 23 45')"
);

/************************************END TABLE IMG_HEADER*******************************/


/************************************END TABLE TOKENS_PASSWORD*******************************/
// Création de table tokens_password

$sql = $db->exec("CREATE TABLE IF NOT EXISTS `tokens_password` ( 
	`id` INT NOT NULL AUTO_INCREMENT , 
	`email` VARCHAR(255) NOT NULL , 
	`token` VARCHAR(255) NOT NULL , 
	`date_create` DATETIME NOT NULL , 
	`date_exp` DATETIME NOT NULL , 
	PRIMARY KEY (`id`)) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;"
); if($sql === false){
	die(var_dump($db->errorInfo()));
}

$sql = $db->exec("INSERT INTO `tokens_password` (
	`id`, 
	`email`, 
	`token`, 
	`date_create`, 
	`date_exp`) 
	VALUES (NULL,
	'',
	'',
	'',
	'')"
);	

/************************************END TABLE TOKENS_PASSWORD*******************************/


/************************************TABLE RESERVE_ONLINE**********************************************************/
$sql = $db->exec("CREATE TABLE IF NOT EXISTS `reserve_online` ( 
	`id` INT NOT NULL AUTO_INCREMENT , 
	`name` VARCHAR(255) NOT NULL , 
	`firstname` VARCHAR(255) NOT NULL , 
	`how_many` INT NOT NULL , 
	`num` INT(10) NOT NULL , 
	`date` DATE NOT NULL , 
	`hour` TIME NOT NULL , 
	`message` VARCHAR(255) NOT NULL , 
	`date_creation` DATETIME NOT NULL , 
	PRIMARY KEY (`id`)) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;"
); if($sql === false){
	die(var_dump($db->errorInfo()));
}

/*********************************END TABLE RESERVE_ONLINE***************************************************************/

if($upValid){
	echo '<br><br><center><p style="font-size: 20px;"<strong>Base de données bien mise a jour</strong></p></center><br>';
	echo '<center><img src="https://media.giphy.com/media/iwVHUKnyvZKEg/giphy.gif"></center>';
	echo '<br><center><p style="font-size: 20px;"<strong><a href="http://'.$_SERVER['HTTP_HOST'].'/AwesomeResto/index.php">Cliquer pour continuer vers le site</a></strong></p></center><br><br>';
}else{
	echo '<br><br><center><p style="font-size: 20px;"<strong>Arrete de recharger la page clique plutot sur ce lien</strong></p></center><br>';
	echo '<center><img src="https://media.giphy.com/media/3t7RAFhu75Wwg/giphy.gif"></center>';
	echo '<br><center><p style="font-size: 20px;"<strong><a href="http://'.$_SERVER['HTTP_HOST'].'/AwesomeResto/index.php">Cliquer pour continuer vers le site</a></strong></p></center><br><br>';
}