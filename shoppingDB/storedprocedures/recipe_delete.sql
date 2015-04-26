DROP PROCEDURE IF EXISTS recipe_delete;
DELIMITER //
CREATE PROCEDURE `recipe_delete`
(
	 pId INT 
)
BEGIN
DELETE FROM `recipe`
	WHERE `recipe`.`recipe_id` = pId;
END //
DELIMITER ;