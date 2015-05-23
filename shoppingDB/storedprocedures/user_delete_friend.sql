USE shopping_db;
DROP PROCEDURE IF EXISTS user_delete_friend;
DELIMITER //
CREATE PROCEDURE `user_delete_friend`
(
	IN pUserId INT ,
	IN pFriendId INT 
)
BEGIN
DELETE FROM `friends`
	WHERE (`friends`.`user_id_inviter` = pUserId OR `friends`. `user_id_invitee` = pUserId) AND (`friends`.`user_id_invitee` = pFriendId OR `friends`.`user_id_inviter` = pFriendId);
END //
DELIMITER ;