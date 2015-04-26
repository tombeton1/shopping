USE shopping_db;
DROP PROCEDURE IF EXISTS user_delete;
DELIMITER //
CREATE PROCEDURE `user_delete`
(
	 pId INT
)
BEGIN
DELETE FROM `users` WHERE `users`.`user_id` = pId;
END //
DELIMITER ;