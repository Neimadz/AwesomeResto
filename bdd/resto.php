<?php 
// création d'une data_base restaurant si elle n'existe pas.
$db = new PDO('mysql:host=localhost;charset=utf8', 'root', '');
$db->query("create database if not exists restaurant");
$db->query("use restaurant"); 


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
	ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;");
if($sql === false){
	die(var_dump($bdd->errorInfo()));
}
$password = password_hash( 'test', PASSWORD_DEFAULT);

// ajoute des users a la bbd
$sql = $db->exec("INSERT INTO `users` (
	`id`,
	`firstname`, 
	`lastname`,
	`role`, 
	`email`, 
	`password`, 
	`date_registration`) 
	VALUES (NULL, 
	'test', 
	'test', 
	'admin', 
	'test@gmail.com', 
	'$password', 
	'2016-05-19 00:00:00')"
);
$sql = $db->exec("INSERT INTO `users` (
	`id`, 
	`firstname`, 
	`lastname`, 
	`role`, 
	`email`, 
	`password`, 
	`date_registration`) 
	VALUES (NULL, 
	'user', 
	'user', 
	'edit', 
	'user@gmail.com', 
	'$password', 
	'2016-05-19 08:18:13')"
);


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
	die(var_dump($bdd->errorInfo()));
}

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
	die(var_dump($bdd->errorInfo()));
}

$sql = $db->exec("INSERT INTO `contact` (
	`id`, 
	`name`, 
	`email`, 
	`message`,
	`is_read`, 
	`date_send`) 
	VALUES (NULL, 
	'machado damien', 
	'dams_m33@hotmail.fr', 
	'Salut je recherche a manger des sushi c\'est ici ?',
	'not_read', 
	'2016-05-19 07:17:13')"
);

// Entrée 1    Griddled vegetables & feta with tabbouleh     recette 1
$sql = $db->exec("INSERT INTO `recipes` (`id`,`author_id`, `role`, `title`, `content`, `link`, `ingredients`, `date_publish`)
	VALUES (NULL,
	'unknow author',
	'entrance',
	'Griddled vegetables & feta with tabbouleh',
	'This is a great meat-free recipe. Barbecuing a whole block of feta is a really interesting way to use it – you get a wicked texture contrast between the beautifully golden outside and the soft, creamy centre. The smoky flavour adds a subtle but beautiful twist to this delicious summery dish.',
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
1	lemon',
 NOW())
");


// Entrée 2    Tasty fish tacos       recette 2
$sql = $db->exec("INSERT INTO `recipes` (`id`,`author_id`, `role`, `title`, `content`, `link`, `ingredients`, `date_publish`)
	VALUES (NULL,
	'unknow author',
	'entrance',
	'Tasty fish tacos',
	'“Just one haddock fillet provides us with a source of seven different essential vitamins and minerals, plus this colourful dish gives us three of our 5-a-day ”',
	'http://cdn.jamieoliver.com/recipe-database/oldImages/xtra_med/1596_9_1439906088.jpg',
	'100	g	plain wholemeal flour
2	ripe kiwi fruit
4	spring onions
1	fresh jalapeño or green chilli
1	bunch of	fresh coriander , (30g)
2	limes
Tabasco chipotle sauce
¼	of a small	red cabbage	, (150g)
1	tablespoon	red wine vinegar
½ an	orange
1	red or yellow pepper
2 x 120g	fillets of firm white fish, such as haddock, skin on, scaled and pin-boned, from sustainable sources
olive oil
2	tablespoons	natural yoghurt
	', NOW())
");


// Entrée 3   Delicious winter salad    recette 3
$sql = $db->exec("INSERT INTO `recipes` (`id`,`author_id`, `role`, `title`, `content`, `link`, `ingredients`, `date_publish`)
	VALUES (NULL,
	'unknow author',
	'entrance',
	'Delicious winter salad',
	'“This is really nice served with a simple pasta, with leftover cold meats, in a sandwich or with a simple jacket potato and knob of butter. Any leftovers can be kept in the fridge then served as a really posh coleslaw. ”',
	'http://cdn.jamieoliver.com/recipe-database/xtra_med/DxuXTkF3qgB9A24KjvZz-a.jpg',
	'½	a	red cabbage
½	a	white cabbage
2	large	carrots
4	spring onions
a few	shoots from winter cabbages, such as kale or cavolo nero , optional
300	ml	milk
4	anchovies, from sustainable sources
6	cloves of	garlic
2	tablespoons	white wine vinegar
6	tablespoons	extra virgin olive oil
1	tesapoons	Dijon mustard
1	handful of	mixed seeds, such as poppy, sesame and sunflower
½	a bunch of	fresh mint
	', NOW())
");

// Plat 1        Piri piri chicken    recette 4
$sql = $db->exec("INSERT INTO `recipes` (`id`,`author_id`, `role`, `title`, `content`, `link`, `ingredients`, `date_publish`) 
	VALUES (NULL,
	'unknow author',
	'dish',
	'Piri piri chicken',
	'“Crisp, spicy roast chicken, served with piri piri sauce, jalapeño salsa and sweet potato wedges – delicious! ”',
	'http://cdn.jamieoliver.com/recipe-database/oldImages/xtra_med/1418_1_1436873314.jpg',
	'1.3	kg	free-range chicken
3	sprigs of	fresh thyme
4	cloves of	garlic
1	teaspoon	sweet smoked paprika
sea salt
freshly ground black pepper
olive oil
2	red onions
4	ripe tomatoes	, mixed colours if possible
6	fresh chillies	, mixed colours if possible
red wine vinegar
extra virgin olive oil
For the sweet potato wedges:
750	g	sweet potatoes
1	teaspoon	smoked paprika
2	tablespoons	fine semolina
For the jalapeño salsa:
1 x 200	g jar of	pickled jalapeños
1	bunch of fresh coriander',
	 NOW())
");


// Plat 2   Wild boar burgers    recette 5
$sql = $db->exec("INSERT INTO `recipes` (`id`,`author_id`, `role`, `title`, `content`, `link`, `ingredients`, `date_publish`) 
	VALUES (NULL,
	'unknow author',
	'dish',
	'Wild boar burgers',
	'“These might be the best boar burgers ever! ”',
	'http://cdn.jamieoliver.com/recipe-database/oldImages/xtra_med/1140_1_1436963553.jpg',
	'500	g	minced wild boar shoulder	, or belly
1	tbsp	brown sauce	, or to taste
Worcestershire sauce	, to taste
1	tbsp	tomato sauce	, or to taste
2	shallots	, finely chopped
4	burger buns
olive oil
2	braeburn apples	, or cox\'s apples, sliced at the last minute to serve',
	 NOW())
");

// Plat 3   Marmexican marinated pork tenderloin    recette 6
$sql = $db->exec("INSERT INTO `recipes` (`id`,`author_id`, `role`, `title`, `content`, `link`, `ingredients`, `date_publish`) 
	VALUES (NULL,
	'unknow author',
	'dish',
	'Marmexican marinated pork tenderloin',
	'“A great Friday night recipe with friends. Get everything in the middle of the table and tuck in.”',
	'http://cdn.jamieoliver.com/recipe-database/xtra_med/74B9VPWGqs8BGNa_ee3BCy.jpg',
	'500	g	piece of pork tenderloin	, trimmed
Olive oil
18	small	corn tortillas
lime wedges	, to serve
Marinade:
Olive oil
2	red onions	, peeled and chopped
6	cloves of	garlic	, peeled and chopped
1/2	large bunch of	coriander	, stalks only (use the leaves for the salsa), finely chopped
2	dried chipotle chillies	, soaked in hot water for 10 minutes, drained, then chopped
1	tsp	ground cumin
1/2	tsp	sweet smoked paprika
3	sprigs of	thyme
2	tbsp	red wine vinegar
1	tbsp	tomato purée
2	tbsp	dark brown sugar
1/2	orange , zest and juice of
Rainbow salad:
1	corn on the cob	, soaked for 10 minutes in cold water
1/4	white cabbage	, finely shredded
2	tbsp	white vinegar
6	mixed radishes	, thinly sliced
2	carrots	, speed-peeled into ribbons with a potato peeler
3	little gem hearts	, cut into thin wedges
Avocado salsa:
2	ripe avocados	, flesh of, smashed
1	green chilli	, finely chopped (deseeded if you like)
2	spring onions	, finely chopped
1/2	small bunch of	coriander	, leaves picked, roughly chopped
1	lime	, zest and juice of
Extra virgin olive oil',
	 NOW())
");

// Dessert 1   Epic ice cream cake   recette 7
$sql = $db->exec("INSERT INTO `recipes` (`id`,`author_id`, `role`, `title`, `content`, `link`, `ingredients`, `date_publish`) 
	VALUES (NULL,
	'unknow author',
	'dessert',
	'Epic ice cream cake',
	'“Choose two or three different flavours of your favourite ice cream for this cake – we went for pistachio, strawberry and vanilla. Then when you slice it open all of the amazing layers will be revealed. ”',
	'http://cdn.jamieoliver.com/recipe-database/xtra_med/8dhIZVN1qOS9cBVMAjX98l.jpg',
	'90	g	butter	, at room temperature, plus extra for greasing
90	g	light brown sugar
1	large	free-range egg
30	g	ground almonds
60	g	self-raising flour
1	tablespoon	cocoa powder
¼	heaped teaspoon	baking powder
30	g	dark chocolate (70% cocoa solids)
50	ml	milk
1.5	litres	ice cream (2-3 flavours)',
	 NOW())
");

// Dessert 2    Chocolate battenberg  recette 8
$sql = $db->exec("INSERT INTO `recipes` (`id`,`author_id`, `role`, `title`, `content`, `link`, `ingredients`, `date_publish`) 
	VALUES (NULL,
	'unknow author',
	'dessert',
	'Chocolate battenberg',
	'“This is made with cocoa instead of pink food colouring. Find marzipan in the supermarket baking aisle. Use the cake off-cuts in a trifle. ”',
	'http://cdn.jamieoliver.com/recipe-database/xtra_med/6H0HUbu6q3v91gE5eklQf6.jpg',
	'350	g	butter	, at room temperature, plus extra for greasing
350	g	caster sugar
6	large	free-range eggs
½	tablespoon	vanilla extract
2	tablespoons	milk
285	g	self-raising flour
50	g	ground almonds
40	g	cocoa powder
125	g	raspberry jam
450	g	marzipan or almond paste',
	 NOW())
");

// Dessert 3    Chocolate & salted caramel cake  recette 9
$sql = $db->exec("INSERT INTO `recipes` (`id`,`author_id`, `role`, `title`, `content`, `link`, `ingredients`, `date_publish`) 
	VALUES (NULL,
	'unknow author',
	'dessert',
	'Chocolate & salted caramel cake',
	'“You don’t use all the caramel, but it keeps in the fridge for a few days. ”',
	'http://cdn.jamieoliver.com/recipe-database/xtra_med/2kUz9apvqo49riq4lB5FBh.jpg',
	'250	g	unsalted butter	, plus extra for greasing
250	g	dark chocolate (70% cocoa solids)
150	ml	espresso
225	g	self-raising flour
250	g	golden caster sugar
250	g	soft light brown sugar
2	tablespoons	cocoa powder
100	ml	buttermilk
4	large	free-range eggs
SALTED CARAMEL
200	g	sugar
50	g	butter
75	ml	double cream
CHOCOLATE GANACHE
50	g	dark chocolate (70% cocoa solids)
50	ml	double cream',
	 NOW())
"); 


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
	die(var_dump($bdd->errorInfo()));
}

$sql = $db->exec("INSERT INTO `img_header` (
	`id`, 
	`img1`, 
	`img2`, 
	`img3`, 
	`adress`) 
	VALUES (NULL, 
	'http://localhost/resto/img/img_header/img_header1.jpg', 
	'http://localhost/resto/img/img_header/img_header2.jpg', 
	'http://localhost/resto/img/img_header/img_header3.jpg', 
	'Ristorante ! 32 rue rosa bonheur 33000 Bordeaux 0 805 62 23 45 ')"
);
