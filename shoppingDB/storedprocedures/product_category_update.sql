DROP PROCEDURE IF EXISTS product_category_update;
DELIMITER //
CREATE PROCEDURE `product_category_update`
(
		pId int,
        pProductCategoryName varchar(100),
		pProductCategoryDescription VARCHAR (5000)
)
        
BEGIN
UPDATE `product_category`
	SET
		`product_category`.`product_category_name` = pProductCategoryName,
		`product_category`.`product_category_description` = pProductCategoryDescription
        
	WHERE `product_category`.`product_category_id` = pId;
END //
DELIMITER ;

