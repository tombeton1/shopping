USE shopping_db;
DROP PROCEDURE IF EXISTS user_add_friend;
DELIMITER //
CREATE PROCEDURE `user_add_friend`
(
	IN pUserId INT ,
	IN pFriendId INT
)
BEGIN
INSERT INTO `friends`
	(
		`friends`.`user_id_inviter`,
		`friends`.`user_id_invitee`
	)
	VALUES
	(
		pUserId,
        pFriendId
	);
END //
DELIMITER ;