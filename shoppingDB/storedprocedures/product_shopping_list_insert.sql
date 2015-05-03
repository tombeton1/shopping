use shopping_db;
DROP PROCEDURE IF EXISTS product_shopping_list_insert;
DELIMITER //
CREATE PROCEDURE `product_shopping_list_insert`
(
	IN pProductId INT,
    IN pShoppingListId INT,
    IN pAmount DOUBLE,
    IN pAmountUnit NVARCHAR (100)
)
BEGIN
INSERT INTO `product_shopping_list`
	(
		`product_shopping_list`.`product_id`,
		`product_shopping_list`.`shopping_list_id`,
		`product_shopping_list`.`amount`,
        `product_shopping_list`.`amount_unit`
	)
	VALUES
	(
		pProductId,
        pShoppingListId,
        pAmount,
        pAmountUnit
	);
END //
DELIMITER ;
