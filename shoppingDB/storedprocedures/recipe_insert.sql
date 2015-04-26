DROP PROCEDURE IF EXISTS recipe_insert;
DELIMITER //
CREATE PROCEDURE `recipe_insert`
(

	IN pRecipeCategory int ,
    IN pRecipeName varchar(50),
    IN pRecipeAmount DOUBLE,
    IN pRecipeAmountUnit VARCHAR (50),
    IN pRecipeText VARCHAR (5000)
)
BEGIN
INSERT INTO `recipe`
	(
		`recipe`.`recipe_category_id`,
		`recipe`.`recipe_name`,
		`recipe`.`recipe_amount`,
		`recipe`.`recipe_amount_unit`,
		`recipe`.`recipe_text`
	)
	VALUES
	(
		pRecipeCategory,
        pRecipeName,
        pRecipeAmount,
        pRecipeAmountUnit,
        pRecipeText
	);

END //
DELIMITER ;