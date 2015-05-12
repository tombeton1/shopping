use shopping_db;

DROP PROCEDURE IF EXISTS shopping_list_update_by_friend;
DELIMITER //
CREATE PROCEDURE `shopping_list_update_by_friend`
(
	pId INT,
	pFriendsText NVARCHAR (1000),
	pLastUpdatedBy INT
)
BEGIN
UPDATE `shopping_list`
	SET
		`friends_text` = pFriendsText,
        `shopping_list_updated` = NOW(),
		`last_updated_by` = pLastUpdatedBy
	WHERE `shopping_list`.`shopping_list_id` = pId;
END //
DELIMITER ;