USE shopping_db;
DROP PROCEDURE IF EXISTS user_check_password;
DELIMITER //
CREATE PROCEDURE `user_check_password`
(
	 pEmail nvarchar (100) 
)
BEGIN
SELECT `users`.`password` FROM `users` WHERE `users`.`email` = pEmail;
END //
DELIMITER ;