USE shopping_db;

DROP PROCEDURE IF EXISTS shopping_list_select_by_user;
DELIMITER //
CREATE PROCEDURE `shopping_list_select_by_user`
(
	pId INT
)
BEGIN
SELECT DISTINCT `invitee`.`first_name`, `shopping_list`.`shopping_list_name`, 
	`shopping_list`.`user_id`, `shopping_list`.`shopping_list_id`, 
    `shopping_list`.`shopping_list_due_date`, `shopping_list`.`shopping_list_updated`, 
    `shopping_list`.`access`, `shopping_list`.`last_updated_by` FROM `friends` 
    INNER JOIN `users` AS `inviter` ON `friends`.`user_id_inviter` = `inviter`.`user_id`
    INNER JOIN `users` AS `invitee` ON `invitee`.`user_id` = `friends`.`user_id_invitee`
    INNER JOIN `shopping_list` ON `invitee`.`user_id` = `shopping_list`.`user_id`
    WHERE (`user_id_inviter` = pId OR `user_id_invitee` = pId) AND `relation_accepted` = 1
    union
SELECT DISTINCT `inviter`.`first_name`, `shopping_list`.`shopping_list_name`, 
	`shopping_list`.`user_id`, `shopping_list`.`shopping_list_id`, 
    `shopping_list`.`shopping_list_due_date`, `shopping_list`.`shopping_list_updated`, 
    `shopping_list`.`access`, `shopping_list`.`last_updated_by` FROM `friends` 
    INNER JOIN `users` AS `inviter` ON `friends`.`user_id_inviter` = `inviter`.`user_id`
    INNER JOIN `users` AS `invitee` ON `invitee`.`user_id` = `friends`.`user_id_invitee`
    INNER JOIN `shopping_list` ON `inviter`.`user_id` = `shopping_list`.`user_id`
    WHERE (`user_id_inviter` = pId OR `user_id_invitee` = pId) AND `relation_accepted` = 1
    union
SELECT DISTINCT `users`.`first_name`, `shopping_list`.`shopping_list_name`, 
	`shopping_list`.`user_id`, `shopping_list`.`shopping_list_id`, 
    `shopping_list`.`shopping_list_due_date`, `shopping_list`.`shopping_list_updated`, 
    `shopping_list`.`access`, `shopping_list`.`last_updated_by` FROM `users`
    INNER JOIN `shopping_list` ON `users`.`user_id` = `shopping_list`.`user_id`
    WHERE `users`.`user_id` = pId
    ORDER BY 6 DESC
;
END //
DELIMITER ;