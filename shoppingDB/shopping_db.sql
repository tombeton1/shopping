-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Machine: localhost
-- Genereertijd: 21 apr 2015 om 15:47
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
-- Tabelstructuur voor tabel `family`
--

CREATE TABLE IF NOT EXISTS `family` (
  `family_id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `family_email` varchar(100) NOT NULL,
  `family_name` varchar(50) NOT NULL,
  `city_code` int(11) NOT NULL,
  `city` varchar(50) DEFAULT NULL,
  `street` varchar(50) DEFAULT NULL,
  `house_number` int(11) DEFAULT NULL,
  PRIMARY KEY (`family_id`),
  UNIQUE KEY `family_email` (`family_email`),
  KEY `member_id` (`member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `member_id` int(11) NOT NULL AUTO_INCREMENT,
  `family_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telephone` int(11) DEFAULT NULL,
  `validated` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`member_id`),
  UNIQUE KEY `email` (`email`),
  KEY `family_id` (`family_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_category_id` int(11) NOT NULL,
  `product_barcode_id` int(11) DEFAULT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_price` decimal(10,0) DEFAULT NULL,
  `product_desciption` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`product_id`),
  KEY `category_id` (`product_category_id`)
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
-- Tabelstructuur voor tabel `recipe`
--

CREATE TABLE IF NOT EXISTS `recipe` (
  `recipe_id` int(11) NOT NULL,
  `recipe_category_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `recipe_name` varchar(50) NOT NULL,
  `recipe_amount` double DEFAULT NULL,
  `recipe_amount_unit` varchar(50) DEFAULT NULL,
  `recipe_text` varchar(5000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `shopping_list_id` int(11) NOT NULL AUTO_INCREMENT,
  `family_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `amount_unit` varchar(100) NOT NULL,
  `shopping_list_due_date` date DEFAULT NULL,
  `shopping_list_last_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`shopping_list_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Beperkingen voor gedumpte tabellen
--

--
-- Beperkingen voor tabel `members`
--
ALTER TABLE `members`
  ADD CONSTRAINT `members_ibfk_1` FOREIGN KEY (`family_id`) REFERENCES `family` (`family_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
