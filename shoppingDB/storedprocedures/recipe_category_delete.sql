DROP PROCEDURE IF EXISTS recipe_category_delete;
DELIMITER //
CREATE PROCEDURE `recipe_category_delete`
(
	 pId INT 
)
BEGIN
DELETE FROM `recipe_category`
	WHERE `recipe_category`.`recipe_category_id` = pId;
END //
DELIMITER ;
