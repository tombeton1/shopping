DROP PROCEDURE IF EXISTS shopping_list_insert;
DELIMITER //
CREATE PROCEDURE `shopping_list_insert`
(
	OUT pId INT ,
	IN pName NVARCHAR (50) ,
    IN pUserId INT,
    IN pAmount DOUBLE,
    IN pAmountUnit NVARCHAR (100),
    IN pCreated NVARCHAR (50),
    IN pDueDate DATE,
    IN pAccess TINYINT
)
BEGIN
INSERT INTO `shopping_list`
	(
		`shopping_list`.`shopping_list_name`,
		`shopping_list`.`user_id`,
		`shopping_list`.`amount`,
		`shopping_list`.`amount_unit`,
		`shopping_list`.`shopping_list_created`,
        `shopping_list`.`shopping_list_due_date`,
        `shopping_list`.`access`
	)
	VALUES
	(
		pName,
        pUserId,
        pAmount,
        pAmountUnit,
        NOW(),
        pDueDate,
        pAccess
	);
	SELECT LAST_INSERT_ID() INTO pId;
END //
DELIMITER ;