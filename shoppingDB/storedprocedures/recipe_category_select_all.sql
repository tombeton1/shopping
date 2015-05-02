DROP PROCEDURE IF EXISTS recipe_category_select_all;
DELIMITER //
CREATE PROCEDURE `recipe_category_select_all`
(
)
BEGIN
SELECT * FROM `recipe_category`

	order by recipe_category_name;

END //
DELIMITER ;