USE shopping_db;
DROP PROCEDURE IF EXISTS user_friend_check;
DELIMITER //
CREATE PROCEDURE `user_friend_check`
(
	IN pUserId INT,
    IN pFriendId INT
)
BEGIN
SELECT COUNT(*) FROM `friends` WHERE `friends`.`user_id_inviter` = pUserId AND `friends`.`user_id_invitee` = pFriendId;
END //
DELIMITER ;