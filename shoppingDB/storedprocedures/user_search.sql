USE shopping_db;
DROP PROCEDURE IF EXISTS user_search;
DELIMITER //
CREATE PROCEDURE `user_search`
(
	 pKeyword varchar(100)
)
BEGIN
SELECT `users`.user_id,`users`.first_name, `users`.last_name, `users`.email   FROM `users`
WHERE (`users`.first_name LIKE pKeyword) OR (CONCAT_WS(' ',`users`.first_name, `users`.last_name) LIKE pKeyword);
END //
DELIMITER ;