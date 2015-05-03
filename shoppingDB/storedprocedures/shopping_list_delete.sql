use shopping_db;
DROP PROCEDURE IF EXISTS shopping_list_delete;
DELIMITER //
CREATE PROCEDURE `shopping_list_delete`
(
	 pId INT 
)
BEGIN
DELETE FROM `shopping_list`
	WHERE `shopping_list`.`shopping_list_id` = pId;
END //
DELIMITER ;