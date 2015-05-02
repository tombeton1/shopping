DROP PROCEDURE IF EXISTS recipe_category_select_one;
DELIMITER //
CREATE PROCEDURE `recipe_category_select_one`
(
	 pId INT 
)
BEGIN
SELECT `recipe_category_id`, `recipe_category_name`, `recipe_category_description` FROM `recipe_category`
		WHERE `recipe_category`.`recipe_category_id` = pId;
END //
DELIMITER ;

call recipe_category_select_one(2);
