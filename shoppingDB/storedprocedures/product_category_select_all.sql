DROP PROCEDURE IF EXISTS product_category_select_all;
DELIMITER //
CREATE PROCEDURE `product_category_select_all`
(
)
BEGIN
SELECT * FROM `product_category`

	order by product_category_name;

END //
DELIMITER ;