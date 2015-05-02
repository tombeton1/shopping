DROP PROCEDURE IF EXISTS recipe_category_insert;
DELIMITER //
CREATE PROCEDURE `recipe_category_insert`
(

    IN pRecipeCategoryName varchar(100),
    IN pRecipeCategoryDescription VARCHAR (5000)
)
BEGIN
INSERT INTO `recipe_category`
	(
		`recipe_category`.`recipe_category_name`,
		`recipe_category`.`recipe_category_description`
	)
	VALUES
	(
		pRecipeCategoryName,
        pRecipeCategoryDescription
	);

END //
DELIMITER ;