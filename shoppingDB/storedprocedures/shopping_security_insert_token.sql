use shopping_security;

DROP PROCEDURE IF EXISTS shopping_security_insert_token;
DELIMITER //
CREATE PROCEDURE `shopping_security_insert_token`
(
	IN pEmail NVARCHAR (50) ,
    IN pToken NVARCHAR (200)
)
BEGIN
REPLACE INTO `tokens`
	SET
		`tokens`.`email` = pEmail,
        `tokens`.`token` = pToken;
END //
DELIMITER ;