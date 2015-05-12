USE shopping_db;

DROP PROCEDURE IF EXISTS shopping_list_select_all;
DELIMITER //
CREATE PROCEDURE `shopping_list_select_all`
(
)
BEGIN
SELECT `shopping_list`.`shopping_list_name`, `shopping_list`.`shopping_list_id`,
	`shopping_list`.`last_updated_by`, `shopping_list`.`shopping_list_due_date`,
    `shopping_list`.`shopping_list_updated`
	FROM `shopping_list`
;
END //
DELIMITER ;