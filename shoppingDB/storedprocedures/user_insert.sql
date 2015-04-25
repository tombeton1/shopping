USE shopping_db;
DROP PROCEDURE IF EXISTS user_insert;
DELIMITER //
CREATE PROCEDURE `user_insert`
(
	IN pfirst_name NVARCHAR (50) ,
	IN plast_name NVARCHAR (50) ,
	IN pcountry NVARCHAR(50) ,
	IN pemail NVARCHAR (100) ,
    IN ppassword CHAR(60)
)
BEGIN
INSERT INTO `users`
	(
		`users`.`first_name`,
		`users`.`last_name`,
		`users`.`country`,
		`users`.`email`,
		`users`.`password`
	)
	VALUES
	(
		pfirst_name,
		plast_name,
		pcountry,
		pemail,
        ppassword
	);
 
	
END //
DELIMITER ;