DROP PROCEDURE IF EXISTS product_select_one;
DELIMITER //
CREATE PROCEDURE `product_select_one`
(
	 pId INT 
)
BEGIN
SELECT * FROM `product`
		WHERE `product`.`product_id` = pId;
END //
DELIMITER ;
