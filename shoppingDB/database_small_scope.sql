CREATE DATABASE  IF NOT EXISTS `shopping_db` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `shopping_db`;
-- MySQL dump 10.13  Distrib 5.6.17, for Win32 (x86)
--
-- Host: localhost    Database: shopping_db
-- ------------------------------------------------------
-- Server version	5.6.22-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `friends`
--

DROP TABLE IF EXISTS `friends`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `friends` (
  `user_id_inviter` int(11) NOT NULL,
  `user_id_invitee` int(11) NOT NULL,
  `relation_accepted` tinyint(1) NOT NULL,
  KEY `user_id_inviter` (`user_id_inviter`),
  KEY `user_id_invitee` (`user_id_invitee`),
  CONSTRAINT `friends_user_id_fkey` FOREIGN KEY (`user_id_inviter`) REFERENCES `users` (`user_id`),
  CONSTRAINT `friends_user_id_fkey1` FOREIGN KEY (`user_id_invitee`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `friends`
--

LOCK TABLES `friends` WRITE;
/*!40000 ALTER TABLE `friends` DISABLE KEYS */;
INSERT INTO `friends` VALUES (3,4,0),(4,2,0),(5,2,0),(6,5,0),(7,5,1),(8,5,1),(8,7,0),(5,4,0);
/*!40000 ALTER TABLE `friends` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shopping_list`
--

DROP TABLE IF EXISTS `shopping_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shopping_list` (
  `shopping_list_name` varchar(50) NOT NULL,
  `shopping_list_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `owner_text` varchar(10000) DEFAULT NULL,
  `friends_text` varchar(1000) DEFAULT NULL,
  `shopping_list_created` varchar(50) NOT NULL,
  `shopping_list_due_date` date DEFAULT NULL,
  `shopping_list_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `access` tinyint(4) NOT NULL DEFAULT '1',
  `last_updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`shopping_list_id`),
  KEY `user_id` (`user_id`),
  KEY `shopping_list_updated_by_fkey_idx` (`last_updated_by`),
  CONSTRAINT `shopping_list_updated_by_fkey` FOREIGN KEY (`last_updated_by`) REFERENCES `users` (`user_id`),
  CONSTRAINT `shopping_list_user_id_fkey` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shopping_list`
--

LOCK TABLES `shopping_list` WRITE;
/*!40000 ALTER TABLE `shopping_list` DISABLE KEYS */;
INSERT INTO `shopping_list` VALUES ('bloemkool',2,2,'','extra informatie','2015-06-02 17:13:21','2015-04-28','2015-06-02 15:23:03',2,3),('inserttest',3,2,'',NULL,'2015-06-02 17:15:57','2015-04-15','2015-06-02 15:15:57',1,NULL),('inserttest',7,4,'',NULL,'2015-06-02 17:55:11','2015-04-15','2015-06-02 15:55:11',1,NULL),('inserttest',8,4,'',NULL,'2015-06-02 17:55:11','2015-04-15','2015-06-02 15:55:11',1,NULL),('bloemkool',10,5,'',NULL,'2015-06-02 17:55:40','2015-04-28','2015-06-07 13:09:36',1,5),('broccoli',11,5,'<p>- <label>test</label> <input type=\"checkbox\"> <input class=\"button-flat button-yellow\" id=\"delete-text-list\" type=\"button\" value=\"Delete\" /></p>',NULL,'2015-06-02 17:55:40','2015-04-28','2015-06-07 13:28:14',0,5),('inserttest',12,5,'',NULL,'2015-06-02 17:55:40','2015-04-15','2015-06-02 15:55:40',1,NULL),('citroen',14,7,'<p>- <label style=\"color: red\">test</label> (testienn) <input type=\"checkbox\"> <input class=\"button-flat button-yellow\" id=\"delete-text-list\" type=\"button\" value=\"Delete\" /></p><p>- <label style=\"color: red\">list</label> (testienn) <input type=\"checkbox\"> <input class=\"button-flat button-yellow\" id=\"delete-text-list\" type=\"button\" value=\"Delete\" /></p>',NULL,'2015-06-05 15:25:23','2015-06-05','2015-06-07 16:15:13',1,5);
/*!40000 ALTER TABLE `shopping_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` char(60) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (2,'tom','adriaens','bla','mljksqfdq','mlqsdkqlm'),(3,'adrie','mlkqsd','qsddqsq','sqddsqdsq','qsddsqqsd'),(4,'test','test','belgie','oualid@lid.com','$2y$10$VwBucYI/ZqK69UTE181p8unJnchUGHfieEJ0TJ0XYxTUbOBx9OEGC'),(5,'testienn','testzazaaez','belgie','test@test.com','$2y$10$0R0UOsafmf72O2ImkKcpBejaVedO/hB7tCCehfFwlWkCU2kjKMjIe'),(6,'lenny','donnez','belgie','lenny@tester.com','$2y$10$XC2re1ld8fMTu2jlIO8gXuTkSZN6JK/ltFeV5nL27N1SYldlOpCE6'),(7,'mokske','hot','belgie','mokske@tester.com','$2y$10$s80zdv0Ha2QKuFLxbyoSF.PggvY98RB6mUporFbFUKRYJ7QciVemO'),(8,'bokske','hot','belgie','bokske@tester.com','$2y$10$AAkAdnzqhFzEgllJ.GczUuMwZAZXvhr3pWoUR/bmjv5J2GAMWs886');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'shopping_db'
--
/*!50003 DROP PROCEDURE IF EXISTS `shopping_list_delete` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `shopping_list_delete`(
	 pId INT 
)
BEGIN
DELETE FROM `shopping_list`
	WHERE `shopping_list`.`shopping_list_id` = pId;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `shopping_list_insert` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `shopping_list_insert`(
	OUT pId INT ,
	IN pName NVARCHAR (50) ,
    IN pUserId INT,
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
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `shopping_list_insert_text` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `shopping_list_insert_text`(
	pId INT,
	pOwnerText NVARCHAR (10000),
	pLastUpdatedBy INT
)
BEGIN
UPDATE `shopping_list`
	SET
		`owner_text` = pOwnerText,
        `shopping_list_updated` = NOW(),
		`last_updated_by` = pLastUpdatedBy
	WHERE `shopping_list`.`shopping_list_id` = pId;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `shopping_list_select_all` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `shopping_list_select_all`(
)
BEGIN
SELECT `shopping_list`.`shopping_list_name`, `shopping_list`.`shopping_list_id`,
	`shopping_list`.`last_updated_by`, `shopping_list`.`shopping_list_due_date`,
    `shopping_list`.`shopping_list_updated`
	FROM `shopping_list`
;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `shopping_list_select_by_user` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `shopping_list_select_by_user`(
	pId INT
)
BEGIN
SELECT DISTINCT `invitee`.`first_name`, `shopping_list`.`shopping_list_name`, 
	`shopping_list`.`user_id`, `shopping_list`.`shopping_list_id`, 
    `shopping_list`.`shopping_list_due_date`, `shopping_list`.`shopping_list_updated`, 
    `shopping_list`.`access`, `shopping_list`.`last_updated_by` FROM `friends` 
    INNER JOIN `users` AS `inviter` ON `friends`.`user_id_inviter` = `inviter`.`user_id`
    INNER JOIN `users` AS `invitee` ON `invitee`.`user_id` = `friends`.`user_id_invitee`
    INNER JOIN `shopping_list` ON `invitee`.`user_id` = `shopping_list`.`user_id`
    WHERE (`user_id_inviter` = pId OR `user_id_invitee` = pId) AND `relation_accepted` = 1
    union
SELECT DISTINCT `inviter`.`first_name`, `shopping_list`.`shopping_list_name`, 
	`shopping_list`.`user_id`, `shopping_list`.`shopping_list_id`, 
    `shopping_list`.`shopping_list_due_date`, `shopping_list`.`shopping_list_updated`, 
    `shopping_list`.`access`, `shopping_list`.`last_updated_by` FROM `friends` 
    INNER JOIN `users` AS `inviter` ON `friends`.`user_id_inviter` = `inviter`.`user_id`
    INNER JOIN `users` AS `invitee` ON `invitee`.`user_id` = `friends`.`user_id_invitee`
    INNER JOIN `shopping_list` ON `inviter`.`user_id` = `shopping_list`.`user_id`
    WHERE (`user_id_inviter` = pId OR `user_id_invitee` = pId) AND `relation_accepted` = 1
    ORDER BY 6 DESC
;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `shopping_list_select_one` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `shopping_list_select_one`(
	 pId INT 
)
BEGIN
SELECT * FROM `shopping_list`
	WHERE `shopping_list`.`shopping_list_id` = pId;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `shopping_list_update` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `shopping_list_update`(
	pId INT ,
	pName NVARCHAR (50) ,
	pUserId INT,
    pDueDate DATE, 
    pAccess TINYINT
)
BEGIN
UPDATE `shopping_list`
	SET
		`shopping_list_name` = pName,
		`shopping_list_due_date` = pDueDate,
		`shopping_list_updated` = NOW(),
		`access` = pAccess,
        `last_updated_by` = pUserId
	WHERE `shopping_list`.`shopping_list_id` = pId;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `shopping_list_update_by_friend` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `shopping_list_update_by_friend`(
	pId INT,
	pFriendsText NVARCHAR (1000),
	pLastUpdatedBy INT
)
BEGIN
UPDATE `shopping_list`
	SET
		`friends_text` = pFriendsText,
        `shopping_list_updated` = NOW(),
		`last_updated_by` = pLastUpdatedBy
	WHERE `shopping_list`.`shopping_list_id` = pId;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `user_accept_friend` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `user_accept_friend`(
	IN pUserId INT ,
	IN pFriendId INT 
)
BEGIN
UPDATE `friends`
	SET
		`relation_accepted` = true
	WHERE (`friends`.`user_id_inviter` = pUserId OR `friends`. `user_id_invitee` = pUserId) AND (`friends`.`user_id_invitee` = pFriendId OR `friends`.`user_id_inviter` = pFriendId);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `user_add_friend` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
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
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `user_check_password` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `user_check_password`(
	 pEmail nvarchar (100) 
)
BEGIN
SELECT `users`.`password`, `users`.first_name, `users`.last_name, `users`.user_id FROM `users` WHERE `users`.`email` = pEmail;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `user_delete` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `user_delete`(
	 pId INT
)
BEGIN
DELETE FROM `users` WHERE `users`.`user_id` = pId;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `user_delete_friend` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `user_delete_friend`(
	IN pUserId INT ,
	IN pFriendId INT 
)
BEGIN
DELETE FROM `friends`
	WHERE (`friends`.`user_id_inviter` = pUserId OR `friends`. `user_id_invitee` = pUserId) AND (`friends`.`user_id_invitee` = pFriendId OR `friends`.`user_id_inviter` = pFriendId);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `user_friend_check` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `user_friend_check`(
	IN pUserId INT,
    IN pFriendId INT
)
BEGIN
SELECT COUNT(*) FROM `friends` WHERE (`friends`.`user_id_inviter` = pUserId OR `friends`. `user_id_invitee` = pUserId) AND (`friends`.`user_id_invitee` = pFriendId OR `friends`.`user_id_inviter` = pFriendId);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `user_insert` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
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
 
	
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `user_search` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `user_search`(
	 pKeyword varchar(100)
)
BEGIN
SELECT `users`.user_id,`users`.first_name, `users`.last_name, `users`.email   FROM `users`
WHERE (`users`.first_name LIKE pKeyword) OR (CONCAT_WS(' ',`users`.first_name, `users`.last_name) LIKE pKeyword);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `user_select_all` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `user_select_all`(
)
BEGIN
SELECT `users`.`user_id`, `users`.`first_name`, `users`.`last_name`, `users`.`country`, `users`.`email`FROM `users`;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `user_select_all_friends` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
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
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `user_select_friends_requests` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
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
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `user_select_one` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `user_select_one`(
	 pId INT 
)
BEGIN
SELECT `users`.`user_id`, `users`.`first_name`, `users`.`last_name`, `users`.`country`, `users`.`email`

	FROM `users`
	WHERE `users`.`user_id` = pId;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `user_update` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
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
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-06-07 18:18:07
