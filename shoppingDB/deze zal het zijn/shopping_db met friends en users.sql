-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Machine: localhost
-- Genereertijd: 24 apr 2015 om 14:02
-- Serverversie: 5.6.13
-- PHP-versie: 5.4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databank: `shopping_db`
--
CREATE DATABASE IF NOT EXISTS `shopping_db` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `shopping_db`;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `friends`
--

CREATE TABLE IF NOT EXISTS `friends` (
  `friends_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id_inviter` int(11) NOT NULL,
  `user_id_invitee` int(11) NOT NULL,
  PRIMARY KEY (`friends_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `friends_invites`
--

CREATE TABLE IF NOT EXISTS `friends_invites` (
  `user_id` int(11) NOT NULL,
  `friends_id` int(11) NOT NULL,
  `relation_accepted` tinyint(1) NOT NULL,
  KEY `member_id` (`user_id`),
  KEY `friends_id` (`friends_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_category_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_price` decimal(10,0) DEFAULT NULL,
  `product_desciption` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`product_id`),
  KEY `category_id` (`product_category_id`),
  KEY `product_category_id` (`product_category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `product_category`
--

CREATE TABLE IF NOT EXISTS `product_category` (
  `product_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_category_name` varchar(100) NOT NULL,
  `product_category_description` varchar(5000) DEFAULT NULL,
  PRIMARY KEY (`product_category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Gegevens worden uitgevoerd voor tabel `product_category`
--

INSERT INTO `product_category` (`product_category_id`, `product_category_name`, `product_category_description`) VALUES
(1, 'groenten', NULL),
(2, 'fruit', NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `product_recipe`
--

CREATE TABLE IF NOT EXISTS `product_recipe` (
  `recipe_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  KEY `recipe_id` (`recipe_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `product_shopping_list`
--

CREATE TABLE IF NOT EXISTS `product_shopping_list` (
  `product_id` int(11) NOT NULL,
  `shopping_list_id` int(11) NOT NULL,
  KEY `product_id` (`product_id`),
  KEY `shopping_list_id` (`shopping_list_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `recipe`
--

CREATE TABLE IF NOT EXISTS `recipe` (
  `recipe_id` int(11) NOT NULL AUTO_INCREMENT,
  `recipe_category_id` int(11) DEFAULT NULL,
  `recipe_name` varchar(50) NOT NULL,
  `recipe_amount` double DEFAULT NULL,
  `recipe_amount_unit` varchar(50) DEFAULT NULL,
  `recipe_text` varchar(5000) DEFAULT NULL,
  PRIMARY KEY (`recipe_id`),
  KEY `recipe_category_id` (`recipe_category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `recipe_category`
--

CREATE TABLE IF NOT EXISTS `recipe_category` (
  `recipe_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `recipe_category_name` varchar(100) NOT NULL,
  `recipe_category_desciption` varchar(5000) DEFAULT NULL,
  PRIMARY KEY (`recipe_category_id`),
  UNIQUE KEY `recipe_category_id` (`recipe_category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Gegevens worden uitgevoerd voor tabel `recipe_category`
--

INSERT INTO `recipe_category` (`recipe_category_id`, `recipe_category_name`, `recipe_category_desciption`) VALUES
(1, 'ontbijt', NULL),
(2, 'middag maal', NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `shopping_list`
--

CREATE TABLE IF NOT EXISTS `shopping_list` (
  `shopping_list_name` varchar(50) NOT NULL,
  `shopping_list_id` int(11) NOT NULL AUTO_INCREMENT,
  `friends_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `amount_unit` varchar(100) NOT NULL,
  `shopping_list_created` varchar(50) NOT NULL,
  `shopping_list_due_date` date DEFAULT NULL,
  `shopping_list_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`shopping_list_id`),
  KEY `family_id` (`friends_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(150) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Beperkingen voor gedumpte tabellen
--

--
-- Beperkingen voor tabel `friends_invites`
--
ALTER TABLE `friends_invites`
  ADD CONSTRAINT `friends_invites_friends_id_fkey` FOREIGN KEY (`friends_id`) REFERENCES `friends` (`friends_id`),
  ADD CONSTRAINT `friends_invites_user_id_fkey` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Beperkingen voor tabel `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_product_product_category_id_fkey` FOREIGN KEY (`product_category_id`) REFERENCES `product_category` (`product_category_id`);

--
-- Beperkingen voor tabel `product_recipe`
--
ALTER TABLE `product_recipe`
  ADD CONSTRAINT `product_recipe_product_id_fkey` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`),
  ADD CONSTRAINT `product_recipe_recipe_id_fkey` FOREIGN KEY (`recipe_id`) REFERENCES `recipe` (`recipe_id`);

--
-- Beperkingen voor tabel `product_shopping_list`
--
ALTER TABLE `product_shopping_list`
  ADD CONSTRAINT `product_shopping_list_shopping_list_id_fkey` FOREIGN KEY (`shopping_list_id`) REFERENCES `shopping_list` (`shopping_list_id`),
  ADD CONSTRAINT `product_shopping_list_product_id_fkey` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Beperkingen voor tabel `recipe`
--
ALTER TABLE `recipe`
  ADD CONSTRAINT `recipe_recipe_category_id_fkey` FOREIGN KEY (`recipe_category_id`) REFERENCES `recipe_category` (`recipe_category_id`);

--
-- Beperkingen voor tabel `shopping_list`
--
ALTER TABLE `shopping_list`
  ADD CONSTRAINT `shopping_list_user_id_fkey` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `shopping_list_friend_fkey` FOREIGN KEY (`friends_id`) REFERENCES `friends` (`friends_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
