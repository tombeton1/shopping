DROP PROCEDURE IF EXISTS recipe_select_one;
DELIMITER //
CREATE PROCEDURE `recipe_select_one`
(
	 pId INT 
)
BEGIN
SELECT * FROM `recipe`
		WHERE `recipe`.`recipe_id` = pId;
END //
DELIMITER ;
