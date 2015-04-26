DROP PROCEDURE IF EXISTS product_category_select_one;
DELIMITER //
CREATE PROCEDURE `product_category_select_one`
(
	 pId INT 
)
BEGIN
SELECT * FROM `product_category`
		WHERE `product_category`.`product_category_id` = pId;
END //
DELIMITER ;
