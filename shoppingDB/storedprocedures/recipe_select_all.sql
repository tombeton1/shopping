DROP PROCEDURE IF EXISTS recipe_select_all;
DELIMITER //
CREATE PROCEDURE `recipe_select_all`
(
)
BEGIN
SELECT * FROM `recipe`
inner join
	`recipe_category` on `recipe`.`recipe_category_id` = `recipe_category`.`recipe_category_id`		
	WHERE `recipe_category`.`recipe_category_id` = pId;

END //
DELIMITER ;





	