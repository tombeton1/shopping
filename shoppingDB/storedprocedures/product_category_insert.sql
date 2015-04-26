DROP PROCEDURE IF EXISTS product_category_insert;
DELIMITER //
CREATE PROCEDURE `product_category_insert`
(

    IN pProductCategoryName varchar(100),
    IN pProductCategoryDescription VARCHAR (5000)
)
BEGIN
INSERT INTO `product_category`
	(
		`product_category`.`product_category_name`,
		`product_category`.`product_category_description`
	)
	VALUES
	(
		pProductCategoryName,
        pProductCategoryDescription
	);

END //
DELIMITER ;