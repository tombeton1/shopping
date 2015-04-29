DROP PROCEDURE IF EXISTS product_select_one;

DELIMITER //
CREATE PROCEDURE `product_select_one`

(
	 pId INT 
)

BEGIN
SELECT * FROM `product`
	outer join	
	`product_category` on `product`.`product_id` = `product_category`.`product_category_id`		
	WHERE `product`.`product_id` = pId;

END //
DELIMITER ;

call product_select_one(7);

