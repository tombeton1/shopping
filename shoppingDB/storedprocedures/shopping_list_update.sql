use shopping_db;

DROP PROCEDURE IF EXISTS shopping_list_update;
DELIMITER //
CREATE PROCEDURE `shopping_list_update`
(
	pId INT ,
	pName NVARCHAR (50) ,
	pUserId INT ,
    pDueDate DATE, 
    pAccess TINYINT
	
)
BEGIN
UPDATE `shopping_list`
	SET
		`shopping_list_name` = pName,
		`user_id` = pUserId,
		`shopping_list_due_date` = pDueDate,
		`shopping_list_updated` = NOW(),
		`access` = pAccess
	WHERE `shopping_list`.`shopping_list_id` = pId;
END //
DELIMITER ;