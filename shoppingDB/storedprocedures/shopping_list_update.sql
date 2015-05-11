use shopping_db;
DROP PROCEDURE IF EXISTS shopping_list_update;
DELIMITER //
CREATE PROCEDURE `shopping_list_update`
(
	pId INT ,
	pName NVARCHAR (50) ,
	pUserId INT,
    pOwnerText NVARCHAR (1000),
    pDueDate DATE, 
    pAccess TINYINT,
	pLastUpdatedBy INT
)
BEGIN
UPDATE `shopping_list`
	SET
		`shopping_list_name` = pName,
		`user_id` = pUserId,
        `owner_text` = pOwnerText,
		`shopping_list_due_date` = pDueDate,
		`shopping_list_updated` = NOW(),
		`access` = pAccess,
        `last_updated_by` = pId
	WHERE `shopping_list`.`shopping_list_id` = pId;
END //
DELIMITER ;