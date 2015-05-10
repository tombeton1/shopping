USE shopping_db;

DROP PROCEDURE IF EXISTS shopping_list_select_by_user;
DELIMITER //
CREATE PROCEDURE `shopping_list_select_by_user`
(
	pId INT
)
BEGIN
SELECT `shopping_list`.`shopping_list_name`, `shopping_list`.`shopping_list_id`
	FROM `shopping_list` WHERE `user_id` = pId
;
END //
DELIMITER ;