use shopping_db;

DROP PROCEDURE IF EXISTS user_update_password;
DELIMITER //
CREATE PROCEDURE `user_update_password`
(
	pUserId INT,
	pNewPassword NVARCHAR (1000)
)
BEGIN
UPDATE `users`
	SET
		`password` = pNewPassword
	WHERE `users`.`user_id` = pUserId;
END //
DELIMITER ;