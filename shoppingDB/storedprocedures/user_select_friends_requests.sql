USE shopping_db;
DROP PROCEDURE IF EXISTS user_select_friends_requests;
DELIMITER //
CREATE PROCEDURE `user_select_friends_requests`
(
	pUserId INT
)
BEGIN
SELECT U.user_Id, U.email, U.first_name, U.Last_name
FROM `users` as `U`, `friends` as `F`
WHERE
CASE
WHEN F.user_id_inviter= U.user_id
THEN F.user_id_invitee= pUserId
END
AND 
F.relation_accepted ='0';
END //
DELIMITER ;
