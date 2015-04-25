DROP PROCEDURE IF EXISTS product_delete;
DELIMITER //
CREATE PROCEDURE `product_delete`
(
	 pId INT 
)
BEGIN
DELETE FROM `product`
	WHERE `product`.`product_id` = pId;
END //
DELIMITER ;
