<?php
/**
 * Created by PhpStorm.
 * User: lenny
 * Date: 10/05/15
 * Time: 00:03
 */

namespace ShoppingApp\Controllers;


class User {
    private $user;

    public function __construct(){
        $this->user = new \ShoppingApp\Model\DaUser();
    }

    public function getUsers(){
        return json_encode($this->user->selectAll());
    }
    public function getUser($id){
        return json_encode($this->user->selectOne($id));
    }
    public function updateUser($User){
        return json_encode($this->user->update($User));
    }
    public function insertUser($User){
        return $this->user->insert($User);
    }
    public function getFriends($id){
        return json_encode($this->user->selectAllFriends($id));
    }
    public function getFriendsRequest($id){
        return json_encode($this->user->selectFriendRequests($id));
    }
    public function searchUsers($keyword){
        return json_encode($this->user->searchUsers($keyword));
    }
    public function acceptRequest($userId, $friendId){
        return json_encode($this->user->acceptFriend($userId, $friendId));
    }
    public function deleteFriend($userId, $friendId){
        return json_encode($this->user->deleteFriend($userId, $friendId));
    }
    public function addFriend($userId, $friendId){
        return $this->user->addFriend($userId, $friendId);
    }
    public function updatePassword($id, $email, $oldPassword, $newPasswordVerify, $newPassword){
        if($newPassword === $newPasswordVerify){
            return $this->user->updatePassword($id, $email, $oldPassword, $newPassword);
        } else {
            return 'passwords does not match';
        }
    }
}