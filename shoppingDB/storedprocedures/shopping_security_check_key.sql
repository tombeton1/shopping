use shopping_security;

DROP PROCEDURE IF EXISTS shopping_security_check_key;
DELIMITER //
CREATE PROCEDURE `shopping_security_check_key`
(
	pKey NVARCHAR (200) 
)
BEGIN
SELECT * FROM `keys`
	WHERE `keys`.`key` = pKey;
END //
DELIMITER ;