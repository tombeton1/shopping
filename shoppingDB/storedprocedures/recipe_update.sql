DROP PROCEDURE IF EXISTS recipe_update;
DELIMITER //
CREATE PROCEDURE `recipe_update`
(
		pID int,
		pRecipeCategory int,
        pRecipeName varchar(50),
        pRecipeAmount double,
        pRecipeAmountUnit varchar(50),
        pRecipeText varchar(5000)
)
        
BEGIN
UPDATE `recipe`
	SET
		`recipe`.`recipe_category_id` = pRecipeCategory,
		`recipe`.`recipe_name` = pRecipeName,
		`recipe`.`recipe_amount` = pRecipeAmount,
		`recipe`.`recipe_amount_unit` = pRecipeAmountUnit,
        `recipe`.`recipe_text` = pRecipeText
        
	WHERE `recipe`.`recipe_id` = pId;
END //
DELIMITER ;