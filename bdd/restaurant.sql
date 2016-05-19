-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 19 Mai 2016 à 11:28
-- Version du serveur :  10.1.9-MariaDB
-- Version de PHP :  5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `restaurant`
--

-- --------------------------------------------------------

--
-- Structure de la table `recipes`
--

CREATE TABLE `recipes` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `link_image` varchar(255) NOT NULL,
  `descript` text NOT NULL,
  `content` text NOT NULL,
  `date_publish` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `recipes`
--

INSERT INTO `recipes` (`id`, `title`, `link_image`, `descript`, `content`, `date_publish`) VALUES
(1, 'Griddled vegetables & feta with tabbouleh', 'http://cdn.jamieoliver.com/recipe-database/xtra_med/BWh5WOT0420A1wV_XQz54o.jpg', '“This is a great meat-free recipe. Barbecuing a whole block of feta is a really interesting way to use it – you get a wicked texture contrast between the beautifully golden outside and the soft, creamy centre. The smoky flavour adds a subtle but beautiful twist to this delicious summery dish.”\r\n', 'Light your barbecue and give the coals time to get nice and hot. \r\n\r\nPick the oregano and parsley leaves, peel and slice the onions into wedges and halve the aubergine lengthways.\r\n\r\nAdd the feta to a small bowl with half the oregano leaves, a drizzle of olive oil and a good pinch of sea salt and black pepper. Set aside to marinate while you prepare the rest of the dish.\r\n\r\nNext make the tabbouleh. Cook the cracked wheat according to the packet instructions, then rinse and drain. Set it aside to cool a little. \r\n\r\nPick and finely chop the mint and parsley, then finely chop the cucumber.\r\n\r\nOnce the cracked wheat has cooled, mix in the mint, parsley and cucumber, a good squeeze of lemon juice and a good pinch of salt and pepper. Have a taste and tweak the seasoning to your liking, then cover and set aside.\r\n\r\nOnce your barbecue is hot enough to start cooking, grill all of the vegetables and the garlic and, once beautifully charred on both sides, transfer them to a chopping board. \r\n\r\nChop up all the veg together, squeezing the garlic cloves out of their skins and squishing the tomatoes. Roughly chop the parsley and remaining oregano leaves into the vegetables, season and drizzle with olive oil. \r\n\r\nCarefully griddle the whole marinated feta on the barbecue for about 3 minutes (this will depend how hot your barbecue is), or until golden and crispy, then gently turn and cook for another 1 to 2 minutes.\r\n\r\nToast the pistachios in a small pan over a medium heat until lightly golden, then spoon over the honey and allow the nuts to caramelise, tossing regularly to stop them from catching in the pan (do not be tempted to touch them because they will be very hot!).\r\n\r\nAfter a couple of minutes, tip them onto a sheet of oiled greaseproof paper to harden and cool, then roughly chop and leave to one side.\r\n\r\nSpoon the tabbouleh onto a large serving dish, then top with the chopped vegetables. \r\n\r\nPlace the griddled feta in the centre, drizzle with a little extra virgin olive oil and scatter over the crispy smashed pistachios. To serve, crumble the feta over the top. Delicious served with toasted flatbreads.', '2016-05-19 11:30:31');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `role` enum('admin','edit') NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date_registration` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
