use shopping_db;

DROP PROCEDURE IF EXISTS shopping_list_insert_text;
DELIMITER //
CREATE PROCEDURE `shopping_list_insert_text`
(
	pId INT,
	pOwnerText NVARCHAR (1000),
	pLastUpdatedBy INT
)
BEGIN
UPDATE `shopping_list`
	SET
		`owner_text` = `owner_text` + pOwnerText,
        `shopping_list_updated` = NOW(),
		`last_updated_by` = pLastUpdatedBy
	WHERE `shopping_list`.`shopping_list_id` = pId;
END //
DELIMITER ;