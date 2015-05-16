use shopping_security;

DROP PROCEDURE IF EXISTS shopping_security_check_token;
DELIMITER //
CREATE PROCEDURE `shopping_security_check_token`
(
	pToken NVARCHAR (200) 
)
BEGIN
SELECT * FROM `tokens`
	WHERE `tokens`.`token` = pToken;
END //
DELIMITER ;