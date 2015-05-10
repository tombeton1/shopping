USE shopping_db;
DROP PROCEDURE IF EXISTS user_check_password;
DELIMITER //
CREATE PROCEDURE `user_check_password`
(
	 OUT pId INT,
	 pEmail nvarchar (100) 
)
BEGIN
SELECT `users`.`password`, `users`.first_name, `users`.last_name, `users`.user_id FROM `users` WHERE `users`.`email` = pEmail;
END //
DELIMITER ;