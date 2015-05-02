-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Machine: localhost
-- Genereertijd: 02 mei 2015 om 16:41
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

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `product_category_delete`(
	 pId INT 
)
BEGIN
DELETE FROM `product_category`
	WHERE `product_category`.`product_category_id` = pId;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `product_category_insert`(

    IN pProductCategoryName varchar(100),
    IN pProductCategoryDescription VARCHAR (5000)
)
BEGIN
INSERT INTO `product_category`
	(
		`product_category`.`product_category_name`,
		`product_category`.`product_category_description`
	)
	VALUES
	(
		pProductCategoryName,
        pProductCategoryDescription
	);

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `product_category_select_all`(
)
BEGIN
SELECT * FROM `product_category`

	order by product_category_name;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `product_category_select_one`(
	 pId INT 
)
BEGIN
SELECT * FROM `product_category`
		WHERE `product_category`.`product_category_id` = pId;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `product_category_update`(
		pId int,
        pProductCategoryName varchar(100),
		pProductCategoryDescription VARCHAR (5000)
)
BEGIN
UPDATE `product_category`
	SET
		`product_category`.`product_category_name` = pProductCategoryName,
		`product_category`.`product_category_description` = pProductCategoryDescription
        
	WHERE `product_category`.`product_category_id` = pId;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `product_delete`(
	 pId INT 
)
BEGIN
DELETE FROM `product`
	WHERE `product`.`product_id` = pId;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `product_insert`(
		IN pProductCategory int,
		IN pProductName varchar (100),
		IN pProductPrice varchar (100),
		IN pProductDescription varchar (200)
)
BEGIN
INSERT INTO `product`
	(
		`product`.`product_category_id`,
		`product`.`product_name`,
		`product`.`product_price`,
		`product`.`product_description`

	)
	VALUES
	(
		pProductCategory,
		pProductName,
		pProductPrice,
		pProductDescription
	);
	
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `product_select_all`(
)
BEGIN
SELECT * FROM `product`
inner join	
	`product_category` on `product`.`product_category_id` = `product_category`.`product_category_id`
	order by product_name;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `product_select_one`(
	 pId INT 
)
BEGIN
SELECT * FROM `product`
	inner join	
	`product_category` on `product`.`product_category_id` = `product_category`.`product_category_id`		
	WHERE `product`.`product_id` = pId;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `product_update`(
	pId int,
	pProductCategory int,
	pProductName varchar (100),
	pProductPrice varchar (100),
	pProductDescription varchar(200)
)
BEGIN
UPDATE `product`
	SET
		`product`.`product_category_id` = pProductCategory,
		`product`.`product_name` = pProductName,
		`product`.`product_price` = pProductPrice,
		`product`.`product_description` = pProductDescription
	WHERE `product`.`product_id` = pId;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `recipe_category_delete`(
	 pId INT 
)
BEGIN
DELETE FROM `recipe_category`
	WHERE `recipe_category`.`recipe_category_id` = pId;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `recipe_category_insert`(

    IN pRecipeCategoryName varchar(100),
    IN pRecipeCategoryDescription VARCHAR (5000)
)
BEGIN
INSERT INTO `recipe_category`
	(
		`recipe_category`.`recipe_category_name`,
		`recipe_category`.`recipe_category_description`
	)
	VALUES
	(
		pRecipeCategoryName,
        pRecipeCategoryDescription
	);

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `recipe_category_select_all`(
)
BEGIN
SELECT * FROM `recipe_category`

	order by recipe_category_name;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `recipe_category_select_one`(
	 pId INT 
)
BEGIN
SELECT `recipe_category_id`, `recipe_category_name`, `recipe_category_description` FROM `recipe_category`
		WHERE `recipe_category`.`recipe_category_id` = pId;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `recipe_category_update`(
		pID int,
        pRecipeCategoryName varchar(100),
        pRecipeCategoryDescription varchar(5000)
)
BEGIN
UPDATE `recipe_category`
	SET

		`recipe_category`.`recipe_category_name` = pRecipeCategoryName,
		`recipe_category`.`recipe_category_description` = pRecipeCategoryDescription
        
	WHERE `recipe_category`.`recipe_category_id` = pId;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `recipe_delete`(
	 pId INT 
)
BEGIN
DELETE FROM `recipe`
	WHERE `recipe`.`recipe_id` = pId;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `recipe_insert`(
	IN pRecipeCategory int ,
    IN pRecipeName varchar(50),
    IN pRecipeAmount DOUBLE,
    IN pRecipeAmountUnit VARCHAR (50),
    IN pRecipeText VARCHAR (5000)
)
BEGIN
INSERT INTO `recipe`
	(
		`recipe`.`recipe_category_id`,
		`recipe`.`recipe_name`,
		`recipe`.`recipe_amount`,
		`recipe`.`recipe_amount_unit`,
		`recipe`.`recipe_text`
	)
	VALUES
	(
		pRecipeCategory,
        pRecipeName,
        pRecipeAmount,
        pRecipeAmountUnit,
        pRecipeText
	);

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `recipe_select_all`(
)
BEGIN
SELECT * FROM `recipe`
inner join
	`recipe_category` on `recipe`.`recipe_category_id` = `recipe_category`.`recipe_category_id`	
	order by recipe_name;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `recipe_select_one`(
	 pId INT 
)
BEGIN
SELECT * FROM `recipe`
	inner join
	`recipe_category` on `recipe`.`recipe_category_id` = `recipe_category`.`recipe_category_id`		
	WHERE `recipe_category`.`recipe_category_id` = pId;
		
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `recipe_update`(
		pID int,
		pRecipeCategory int,
        pRecipeName varchar(50),
        pRecipeAmount double,
        pRecipeAmountUnit varchar(50),
        pRecipeText varchar(5000)
)
BEGIN
UPDATE `recipe`
	SET
		`recipe`.`recipe_category_id` = pRecipeCategory,
		`recipe`.`recipe_name` = pRecipeName,
		`recipe`.`recipe_amount` = pRecipeAmount,
		`recipe`.`recipe_amount_unit` = pRecipeAmountUnit,
        `recipe`.`recipe_text` = pRecipeText
        
	WHERE `recipe`.`recipe_id` = pId;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `shopping_list_delete`(
	 pId INT 
)
BEGIN
DELETE FROM `shopping_list`
	WHERE `shopping_list`.`shopping_list_id` = pId;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `shopping_list_insert`(
	OUT pId INT ,
	IN pName NVARCHAR (50) ,
    IN pUserId INT,
    IN pAmount DOUBLE,
    IN pAmountUnit NVARCHAR (100),
    IN pCreated NVARCHAR (50),
    IN pDueDate DATE,
    IN pAccess TINYINT
)
BEGIN
INSERT INTO `shopping_list`
	(
		`shopping_list`.`shopping_list_name`,
		`shopping_list`.`user_id`,
		`shopping_list`.`amount`,
		`shopping_list`.`amount_unit`,
		`shopping_list`.`shopping_list_created`,
        `shopping_list`.`shopping_list_due_date`,
        `shopping_list`.`access`
	)
	VALUES
	(
		pName,
        pUserId,
        pAmount,
        pAmountUnit,
        NOW(),
        pDueDate,
        pAccess
	);
	SELECT LAST_INSERT_ID() INTO pId;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `shopping_list_select_all`(
)
BEGIN
SELECT `shopping_list`.`shopping_list_name`, `shopping_list`.`shopping_list_id`
	FROM `shopping_list`
;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `shopping_list_update`(
	pId INT ,
	pName NVARCHAR (50) ,
	pUserId INT ,
    pDueDate DATE, 
    pAccess TINYINT
	
)
BEGIN
UPDATE `shopping_list`
	SET
		`shopping_list_name` = pName,
		`user_id` = pUserId,
		`shopping_list_due_date` = pDueDate,
		`shopping_list_updated` = NOW(),
		`access` = pAccess
	WHERE `shopping_list`.`shopping_list_id` = pId;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `user_accept_friend`(
	IN pUserId INT ,
	IN pFriendId INT 
)
BEGIN
UPDATE `friends`
	SET
		`relation_accepted` = true
	WHERE (`friends`.`user_id_inviter` = pUserId OR `friends`. `user_id_invitee` = pUserId) AND (`friends`.`user_id_invitee` = pFriendId OR `friends`.`user_id_inviter` = pFriendId);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `user_add_friend`(
	IN pUserId INT ,
	IN pFriendId INT
)
BEGIN
INSERT INTO `friends`
	(
		`friends`.`user_id_inviter`,
		`friends`.`user_id_invitee`
	)
	VALUES
	(
		pUserId,
        pFriendId
	);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `user_check_password`(
	 pEmail nvarchar (100) 
)
BEGIN
SELECT `users`.`password` FROM `users` WHERE `users`.`email` = pEmail;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `user_delete`(
	 pId INT
)
BEGIN
DELETE FROM `users` WHERE `users`.`user_id` = pId;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `user_friend_check`(
	IN pUserId INT,
    IN pFriendId INT
)
BEGIN
SELECT COUNT(*) FROM `friends` WHERE (`friends`.`user_id_inviter` = pUserId OR `friends`. `user_id_invitee` = pUserId) AND (`friends`.`user_id_invitee` = pFriendId OR `friends`.`user_id_inviter` = pFriendId);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `user_insert`(
	IN pfirst_name NVARCHAR (50) ,
	IN plast_name NVARCHAR (50) ,
	IN pcountry NVARCHAR(50) ,
	IN pemail NVARCHAR (100) ,
    IN ppassword CHAR(60)
)
BEGIN
INSERT INTO `users`
	(
		`users`.`first_name`,
		`users`.`last_name`,
		`users`.`country`,
		`users`.`email`,
		`users`.`password`
	)
	VALUES
	(
		pfirst_name,
		plast_name,
		pcountry,
		pemail,
        ppassword
	);
 
	
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `user_select_all`(
)
BEGIN
SELECT `users`.`user_id`, `users`.`first_name`, `users`.`last_name`, `users`.`country`, `users`.`email`FROM `users`;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `user_select_all_friends`(
	pUserId INT
)
BEGIN
SELECT U.user_Id, U.email, U.first_name, U.Last_name
FROM `users` as `U`, `friends` as `F`
WHERE
CASE
WHEN F.user_id_inviter = pUserId
THEN F.user_id_invitee = U.user_id
WHEN F.user_id_inviter= U.user_id
THEN F.user_id_invitee= pUserId
END
AND 
F.relation_accepted ='1';
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `user_select_one`(
	 pId INT 
)
BEGIN
SELECT `users`.`user_id`, `users`.`first_name`, `users`.`last_name`, `users`.`country`, `users`.`email`

	FROM `users`
	WHERE `users`.`user_id` = pId;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `user_update`(
	pId INT(11) ,
	pFirstName NVARCHAR (50) ,
	pLastName NVARCHAR (50),
    pCountry NVARCHAR (50),
	pEmail NVARCHAR(100) 
)
BEGIN
UPDATE `users`
	SET
		`first_name` = pFirstName,
		`last_name` = pLastName,
		`country` = pCountry,
		`email` = pEmail
	WHERE `users`.`user_id` = pId;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `friends`
--

CREATE TABLE IF NOT EXISTS `friends` (
  `user_id_inviter` int(11) NOT NULL,
  `user_id_invitee` int(11) NOT NULL,
  `relation_accepted` tinyint(1) NOT NULL,
  KEY `user_id_inviter` (`user_id_inviter`),
  KEY `user_id_invitee` (`user_id_invitee`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_category_id` int(11) DEFAULT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_price` varchar(100) DEFAULT NULL,
  `product_description` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`product_id`),
  KEY `category_id` (`product_category_id`),
  KEY `product_category_id` (`product_category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Gegevens worden uitgevoerd voor tabel `product`
--

INSERT INTO `product` (`product_id`, `product_category_id`, `product_name`, `product_price`, `product_description`) VALUES
(2, 1, 'product1', 'Aldi, 10', 'blal lalal  alla llallalal'),
(3, 2, 'product Updated2', 'Super, 60', 'blal lalal  alla llallalal'),
(6, 2, 'product2', 'Super, 60', 'blal lalal  alla llallalal'),
(7, 1, 'sla', '1,95', 'lkklqsjdlkjq lksdq jqlskjd lkqsjd'),
(8, 1, 'product1111', 'Super, 60', 'blal lalal  alla llallalal'),
(9, 1, 'product1111', 'Super, 60', 'blal lalal  alla llallalal'),
(10, 1, 'product1111', 'Super, 60', 'blal lalal  alla llallalal');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `product_category`
--

CREATE TABLE IF NOT EXISTS `product_category` (
  `product_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_category_name` varchar(100) NOT NULL,
  `product_category_description` varchar(5000) DEFAULT NULL,
  PRIMARY KEY (`product_category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Gegevens worden uitgevoerd voor tabel `product_category`
--

INSERT INTO `product_category` (`product_category_id`, `product_category_name`, `product_category_description`) VALUES
(1, 'groenten', 'verse gekuiste groenten'),
(2, 'fruit', NULL),
(3, 'avondmaal maar echt slecht', 'snel klaar'),
(5, 'Eenvoudig avond maal', 'snel klaar');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `product_recipe`
--

CREATE TABLE IF NOT EXISTS `product_recipe` (
  `recipe_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `recipe_amount` double DEFAULT NULL,
  `recipe_amount_unit` varchar(50) DEFAULT NULL,
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
  `amount` double DEFAULT NULL,
  `amount_unit` varchar(100) DEFAULT NULL,
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
  `recipe_text` varchar(5000) DEFAULT NULL,
  PRIMARY KEY (`recipe_id`),
  KEY `recipe_category_id` (`recipe_category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Gegevens worden uitgevoerd voor tabel `recipe`
--

INSERT INTO `recipe` (`recipe_id`, `recipe_category_id`, `recipe_name`, `recipe_text`) VALUES
(3, 1, 'aarbeien', 'mqsdlmqsdklmdsql'),
(4, 1, 'asperges', 'lksqjqlskfjqslkjkldjqlkdjq');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `recipe_category`
--

CREATE TABLE IF NOT EXISTS `recipe_category` (
  `recipe_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `recipe_category_name` varchar(100) NOT NULL,
  `recipe_category_description` varchar(5000) DEFAULT NULL,
  PRIMARY KEY (`recipe_category_id`),
  UNIQUE KEY `recipe_category_id` (`recipe_category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Gegevens worden uitgevoerd voor tabel `recipe_category`
--

INSERT INTO `recipe_category` (`recipe_category_id`, `recipe_category_name`, `recipe_category_description`) VALUES
(1, 'avond maal', 'niet gemakkelijk'),
(2, 'middag maal', 'sqsd sfd qsffd qfqsf ');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `shopping_list`
--

CREATE TABLE IF NOT EXISTS `shopping_list` (
  `shopping_list_name` varchar(50) NOT NULL,
  `shopping_list_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `shopping_list_created` varchar(50) NOT NULL,
  `shopping_list_due_date` date DEFAULT NULL,
  `shopping_list_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `access` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`shopping_list_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Gegevens worden uitgevoerd voor tabel `shopping_list`
--

INSERT INTO `shopping_list` (`shopping_list_name`, `shopping_list_id`, `user_id`, `shopping_list_created`, `shopping_list_due_date`, `shopping_list_updated`, `access`) VALUES
('eerste', 1, 2, '20/12/2014', '2015-04-15', '2015-04-27 17:10:34', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` char(60) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Gegevens worden uitgevoerd voor tabel `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `country`, `email`, `password`) VALUES
(2, 'tom', 'adriaens', 'bla', 'mljksqfdq', 'mlqsdkqlm'),
(3, 'adrie', 'mlkqsd', 'qsddqsq', 'sqddsqdsq', 'qsddsqqsd');

--
-- Beperkingen voor gedumpte tabellen
--

--
-- Beperkingen voor tabel `friends`
--
ALTER TABLE `friends`
  ADD CONSTRAINT `friends_user_id_fkey` FOREIGN KEY (`user_id_inviter`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `friends_user_id_fkey1` FOREIGN KEY (`user_id_invitee`) REFERENCES `users` (`user_id`);

--
-- Beperkingen voor tabel `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_product_product_category_id_fkey` FOREIGN KEY (`product_category_id`) REFERENCES `product_category` (`product_category_id`);

--
-- Beperkingen voor tabel `product_recipe`
--
ALTER TABLE `product_recipe`
  ADD CONSTRAINT `product_recipe_product_id_fkey` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_recipe_recipe_id_fkey` FOREIGN KEY (`recipe_id`) REFERENCES `recipe` (`recipe_id`) ON DELETE CASCADE;

--
-- Beperkingen voor tabel `product_shopping_list`
--
ALTER TABLE `product_shopping_list`
  ADD CONSTRAINT `product_shopping_list_product_id_fkey` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`),
  ADD CONSTRAINT `product_shopping_list_shopping_list_id_fkey` FOREIGN KEY (`shopping_list_id`) REFERENCES `shopping_list` (`shopping_list_id`);

--
-- Beperkingen voor tabel `recipe`
--
ALTER TABLE `recipe`
  ADD CONSTRAINT `recipe_recipe_category_id_fkey` FOREIGN KEY (`recipe_category_id`) REFERENCES `recipe_category` (`recipe_category_id`);

--
-- Beperkingen voor tabel `shopping_list`
--
ALTER TABLE `shopping_list`
  ADD CONSTRAINT `shopping_list_user_id_fkey` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
