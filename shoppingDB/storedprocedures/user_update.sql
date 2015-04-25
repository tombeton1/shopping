USE shopping_db;
DROP PROCEDURE IF EXISTS user_update;
DELIMITER //
CREATE PROCEDURE `user_update`
(
	puser_id INT ,
	pfirst_name NVARCHAR (50) ,
	plast_name NVARCHAR (50),
    pcountry NVARCHAR (50),
	pemail NVARCHAR(100) ,
	ppassword CHAR (60) , 
)
BEGIN
UPDATE `Entrant`
	SET
		`UserName` = pUserName,
		`Email` = pEmail,
		`Session01` = pSession01,
		`UpdatedBy` = pUpdatedBy,
		`UpdatedOn` = NOW()
	WHERE `Entrant`.`Id` = pId;
END //
DELIMITER ;