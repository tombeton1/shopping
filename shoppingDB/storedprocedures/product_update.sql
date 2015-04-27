DROP PROCEDURE IF EXISTS product_update;
DELIMITER //
CREATE PROCEDURE `product_update`
(
	pId int,
	pProductCategory int,
	pProductName varchar (100),
	pProductPrice varchar (100),
	pProductDescription varchar(200)
)
BEGIN
UPDATE `product`
	SET
		`product`.`product_category_id` = pProductCategory,
		`product`.`product_name` = pProductName,
		`product`.`product_price` = pProductPrice,
		`product`.`product_description` = pProductDescription
	WHERE `product`.`product_id` = pId;
END //
DELIMITER ;