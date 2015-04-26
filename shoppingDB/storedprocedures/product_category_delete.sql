DROP PROCEDURE IF EXISTS product_category_delete;
DELIMITER //
CREATE PROCEDURE `product_category_delete`
(
	 pId INT 
)
BEGIN
DELETE FROM `product_category`
	WHERE `product_category`.`product_category_id` = pId;
END //
DELIMITER ;
