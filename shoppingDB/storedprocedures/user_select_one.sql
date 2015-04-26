USE shopping_db;
DROP PROCEDURE IF EXISTS user_select_one;
DELIMITER //
CREATE PROCEDURE `user_select_one`
(
	 pId INT 
)
BEGIN
SELECT `users`.`user_id`, `users`.`first_name`, `users`.`last_name`, `users`.`country`, `users`.`email`

	FROM `users`
	WHERE `users`.`user_id` = pId;
END //
DELIMITER ;