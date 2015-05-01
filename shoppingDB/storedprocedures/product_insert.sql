USE shopping_db;

DROP PROCEDURE IF EXISTS product_insert;
DELIMITER //
CREATE PROCEDURE `product_insert`
(
		IN pProductCategory int,
		IN pProductName varchar (100),
		IN pProductPrice varchar (100),
		IN pProductDescription varchar (200)
)
BEGIN
INSERT INTO `product`
	(
		`product`.`product_category_id`,
		`product`.`product_name`,
		`product`.`product_price`,
		`product`.`product_description`

	)
	VALUES
	(
		pProductCategory,
		pProductName,
		pProductPrice,
		pProductDescription
	);
	
END