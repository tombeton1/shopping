use shopping_security;

DROP PROCEDURE IF EXISTS shopping_security_check_api;
DELIMITER //
CREATE PROCEDURE `shopping_security_check_api`
(
	pEmail NVARCHAR (200) 
)
BEGIN
SELECT `keys`.`key` FROM `keys`
	WHERE `keys`.`email` = pEmail;
END //
DELIMITER ;