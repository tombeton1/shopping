DROP PROCEDURE IF EXISTS product_select_one;

DELIMITER //
CREATE PROCEDURE `product_select_one`

(
	 pId INT 
)

BEGIN
SELECT * FROM `product`
	inner join	
	`product_category` on `product`.`product_category_id` = `product_category`.`product_category_id`		
	WHERE `product`.`product_id` = pId;

END //product_insert
DELIMITER ;





