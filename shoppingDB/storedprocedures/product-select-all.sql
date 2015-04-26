DROP PROCEDURE IF EXISTS product_select_all;
DELIMITER //
CREATE PROCEDURE `product_select_all`
(
)
BEGIN
SELECT * FROM `product`
	order by product_name;

END //
DELIMITER ;
