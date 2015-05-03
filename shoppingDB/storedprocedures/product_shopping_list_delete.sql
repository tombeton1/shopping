use shopping_db;
DROP PROCEDURE IF EXISTS product_shopping_list_delete;
DELIMITER //
CREATE PROCEDURE `product_shopping_list_delete`
(
	 pId INT 
)
BEGIN
DELETE FROM `product_shopping_list`
	WHERE `product_shopping_list`.`shopping_list_id` = pId;
END //
DELIMITER ;