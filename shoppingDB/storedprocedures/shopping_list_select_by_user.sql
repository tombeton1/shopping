USE shopping_db;

DROP PROCEDURE IF EXISTS shopping_list_select_by_user;
DELIMITER //
CREATE PROCEDURE `shopping_list_select_by_user`
(
	pId INT
)
BEGIN
SELECT `shopping_list`.`shopping_list_name`, `shopping_list`.`shopping_list_id`,
	`shopping_list`.`last_updated_by`, `shopping_list`.`shopping_list_due_date`,
    `shopping_list`.`shopping_list_updated`, `access`
	FROM `shopping_list` WHERE `user_id` = pId
    ORDER BY `shopping_list_updated` DESC
;
END //
DELIMITER ;