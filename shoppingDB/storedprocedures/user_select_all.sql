USE shopping_db;
DROP PROCEDURE IF EXISTS user_select_all;
DELIMITER //
CREATE PROCEDURE `user_select_all`
(
)
BEGIN
SELECT `users`.`user_id`, `users`.`first_name`, `users`.`last_name`, `users`.`country`, `users`.`email`FROM `users`;
END //
DELIMITER ;