USE shopping_db;

DROP PROCEDURE IF EXISTS shopping_list_select_all;
DELIMITER //
CREATE PROCEDURE `shopping_list_select_all`
(
)
BEGIN
SELECT `shopping_list`.`shopping_list_name`, `shopping_list`.`shopping_list_id`
	FROM `shopping_list`
;
END //
DELIMITER ;