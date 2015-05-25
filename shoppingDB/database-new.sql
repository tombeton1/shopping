-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: May 25, 2015 at 02:16 PM
-- Server version: 5.5.38
-- PHP Version: 5.6.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `shopping_db`
--
CREATE DATABASE IF NOT EXISTS `shopping_db` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `shopping_db`;

DELIMITER $$
--
-- Procedures
--
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
    IN pCreated NVARCHAR (50),
    IN pDueDate DATE,
    IN pAccess TINYINT
)
BEGIN
INSERT INTO `shopping_list`
	(
		`shopping_list`.`shopping_list_name`,
		`shopping_list`.`user_id`,
		`shopping_list`.`shopping_list_created`,
        `shopping_list`.`shopping_list_due_date`,
        `shopping_list`.`access`
	)
	VALUES
	(
		pName,
        pUserId,
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `shopping_list_select_by_user`(
	pId INT
)
BEGIN
SELECT `shopping_list`.`shopping_list_name`, `shopping_list`.`shopping_list_id`
	FROM `shopping_list` WHERE `user_id` = pId
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
SELECT `users`.`password`, `users`.first_name, `users`.last_name, `users`.user_id FROM `users` WHERE `users`.`email` = pEmail;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `user_delete`(
	 pId INT
)
BEGIN
DELETE FROM `users` WHERE `users`.`user_id` = pId;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `user_delete_friend`(
	IN pUserId INT ,
	IN pFriendId INT 
)
BEGIN
DELETE FROM `friends`
	WHERE (`friends`.`user_id_inviter` = pUserId OR `friends`. `user_id_invitee` = pUserId) AND (`friends`.`user_id_invitee` = pFriendId OR `friends`.`user_id_inviter` = pFriendId);
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `user_search`(
	 pKeyword varchar(100)
)
BEGIN
SELECT `users`.user_id,`users`.first_name, `users`.last_name, `users`.email   FROM `users`
WHERE (`users`.first_name LIKE pKeyword) OR (CONCAT_WS(' ',`users`.first_name, `users`.last_name) LIKE pKeyword);
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `user_select_friends_requests`(
	pUserId INT
)
BEGIN
SELECT U.user_Id, U.email, U.first_name, U.Last_name
FROM `users` as `U`, `friends` as `F`
WHERE
CASE
WHEN F.user_id_inviter= U.user_id
THEN F.user_id_invitee= pUserId
END
AND 
F.relation_accepted ='0';
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
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `user_id_inviter` int(11) NOT NULL,
  `user_id_invitee` int(11) NOT NULL,
  `relation_accepted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`user_id_inviter`, `user_id_invitee`, `relation_accepted`) VALUES
(3, 4, 0),
(4, 2, 0),
(5, 2, 0),
(6, 5, 0),
(7, 5, 1),
(8, 5, 1),
(8, 7, 0);

-- --------------------------------------------------------

--
-- Table structure for table `shopping_list`
--

CREATE TABLE `shopping_list` (
  `shopping_list_name` varchar(50) NOT NULL,
`shopping_list_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `owner_text` varchar(1000) DEFAULT NULL,
  `friends_text` varchar(1000) DEFAULT NULL,
  `shopping_list_created` varchar(50) NOT NULL,
  `shopping_list_due_date` date DEFAULT NULL,
  `shopping_list_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `access` tinyint(4) NOT NULL DEFAULT '1',
  `last_updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
`user_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` char(60) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `country`, `email`, `password`) VALUES
(2, 'tom', 'adriaens', 'bla', 'mljksqfdq', 'mlqsdkqlm'),
(3, 'adrie', 'mlkqsd', 'qsddqsq', 'sqddsqdsq', 'qsddsqqsd'),
(4, 'test', 'test', 'belgie', 'oualid@lid.com', '$2y$10$VwBucYI/ZqK69UTE181p8unJnchUGHfieEJ0TJ0XYxTUbOBx9OEGC'),
(5, 'tester', 'testzazaaez', 'belgie', 'test@test.com', '$2y$10$0R0UOsafmf72O2ImkKcpBejaVedO/hB7tCCehfFwlWkCU2kjKMjIe'),
(6, 'lenny', 'donnez', 'belgie', 'lenny@tester.com', '$2y$10$XC2re1ld8fMTu2jlIO8gXuTkSZN6JK/ltFeV5nL27N1SYldlOpCE6'),
(7, 'mokske', 'hot', 'belgie', 'mokske@tester.com', '$2y$10$s80zdv0Ha2QKuFLxbyoSF.PggvY98RB6mUporFbFUKRYJ7QciVemO'),
(8, 'bokske', 'hot', 'belgie', 'bokske@tester.com', '$2y$10$AAkAdnzqhFzEgllJ.GczUuMwZAZXvhr3pWoUR/bmjv5J2GAMWs886');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
 ADD KEY `user_id_inviter` (`user_id_inviter`), ADD KEY `user_id_invitee` (`user_id_invitee`);

--
-- Indexes for table `shopping_list`
--
ALTER TABLE `shopping_list`
 ADD PRIMARY KEY (`shopping_list_id`), ADD KEY `user_id` (`user_id`), ADD KEY `shopping_list_updated_by_fkey_idx` (`last_updated_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`user_id`), ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `shopping_list`
--
ALTER TABLE `shopping_list`
MODIFY `shopping_list_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `friends`
--
ALTER TABLE `friends`
ADD CONSTRAINT `friends_user_id_fkey` FOREIGN KEY (`user_id_inviter`) REFERENCES `users` (`user_id`),
ADD CONSTRAINT `friends_user_id_fkey1` FOREIGN KEY (`user_id_invitee`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `shopping_list`
--
ALTER TABLE `shopping_list`
ADD CONSTRAINT `shopping_list_updated_by_fkey` FOREIGN KEY (`last_updated_by`) REFERENCES `users` (`user_id`),
ADD CONSTRAINT `shopping_list_user_id_fkey` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
--
-- Database: `shopping_security`
--
CREATE DATABASE IF NOT EXISTS `shopping_security` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `shopping_security`;

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `shopping_security_check_token`(
	pToken NVARCHAR (200) 
)
BEGIN
SELECT * FROM `tokens`
	WHERE `tokens`.`token` = pToken;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `shopping_security_insert_token`(
	IN pEmail NVARCHAR (50) ,
    IN pToken NVARCHAR (200)
)
BEGIN
REPLACE INTO `tokens`
	SET
		`tokens`.`email` = pEmail,
        `tokens`.`token` = pToken;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tokens`
--

CREATE TABLE `tokens` (
  `Email` varchar(50) NOT NULL,
  `Token` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tokens`
--

INSERT INTO `tokens` (`Email`, `Token`) VALUES
('bokske@tester.com', '7e2818bee57d27c453570f2d4811c356b655f7dfa5ede0f53f4b013b28b3587e73fc9b916f41554cec91f3c1751c727e320eef81a58c146b45cd553b06fda80d'),
('lenny@tester.com', '05cf21f3e518083a07c7a4b5d2988d38fd28ebd0d9ff0eebf8ddabed8f364ba547450215639639b4e9f3118ed5a552df99690d34f933963e076da8f96c37fc50'),
('mokske@tester.com', '08b7f388ab47fcb2a338e68433c22e2b20114207de8675a92a0a5512ed7466191f05b8fdca69d9e295a94026a416f781d9013aad27619a83108b08550884ef1a'),
('test@test.com', 'a212408022db5dad3ec215eff061ceb86aa4f0b957b0da7b87fcb43bbc5d496cc140aa8652ae550ad533b09d0ad126ea00aea9a194adf24f2e06b01a9da88814');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tokens`
--
ALTER TABLE `tokens`
 ADD PRIMARY KEY (`Email`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
