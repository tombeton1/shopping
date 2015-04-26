DROP PROCEDURE IF EXISTS recipe_category_update;
DELIMITER //
CREATE PROCEDURE `recipe_category_update`
(
		pID int,
        pRecipeCategoryName varchar(100),
        pRecipeCategoryDescription varchar(5000)
)
        
BEGIN
UPDATE `recipe_category`
	SET

		`recipe_category`.`recipe_category_desciption` = pRecipeCategoryName,
		`recipe_category`.`recipe_category_desciption` = pRecipeCategoryDescription
        
	WHERE `recipe`.`recipe_id` = pId;
END //
DELIMITER ;