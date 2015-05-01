DROP PROCEDURE IF EXISTS product_select_all;
DELIMITER //
CREATE PROCEDURE `product_select_all`
(
)
BEGIN
SELECT * FROM `product`
inner join	
	`product_category` on `product`.`product_category_id` = `product_category`.`product_category_id`
	order by product_name;

END //
DELIMITER ;

