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
        return json_encode($this->user->insert($User));
    }
    public function  getMessage(){
        return json_encode($this->user->getMessage());
    }
    public function getFriends($id){
        return json_encode($this->user->selectAllFriends($id));
    }
}