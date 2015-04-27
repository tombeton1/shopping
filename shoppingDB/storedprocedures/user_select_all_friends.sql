USE shopping_db;
DROP PROCEDURE IF EXISTS user_select_all_friends;
DELIMITER //
CREATE PROCEDURE `user_select_all_friends`
(
	pUserId INT
)
BEGIN
SELECT U.user_Id, U.email, U.first_name, U.Last_name
FROM `users` as `U`, `friends` as `F`
WHERE
CASE
WHEN F.user_id_inviter = pUserId
THEN F.user_id_invitee = U.user_id
WHEN F.user_id_inviter= U.user_id
THEN F.user_id_invitee= pUserId
END
AND 
F.relation_accepted ='1';
END //
DELIMITER ;

