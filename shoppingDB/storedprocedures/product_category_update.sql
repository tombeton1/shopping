DROP PROCEDURE IF EXISTS product_category_update;
DELIMITER //
CREATE PROCEDURE `product_category_update`
(
		pID int,
        pProductCategoryName varchar(100),
		pProductCategoryDescription VARCHAR (5000)
)
        
BEGIN
UPDATE `product_category`
	SET

		`product_category`.`product_category_name` = pProductCategoryName,
		`product_category`.`product_category_description` = pProductCategoryDescription
        
	WHERE `recipe`.`recipe_id` = pId;
END //
DELIMITER ;