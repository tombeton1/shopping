USE shopping_db;

DROP PROCEDURE IF EXISTS shopping_list_select_one;
DELIMITER //
CREATE PROCEDURE `shopping_list_select_one`
(
	 pId INT 
)
BEGIN
SELECT * FROM `shopping_list`
	WHERE `shopping_list`.`shopping_list_id` = pId;
END //
DELIMITER ;