<?php
/**
 * Created by PhpStorm.
 * User: lenny
 * Date: 24/04/15
 * Time: 21:39
 */

namespace ShoppingApp\Dal;
include_once '../../vendor/autoload.php';


class DaUser
{

    public static function insert($User)
    {
        $message = NULL;
        try {
            $conn = \ShoppingApp\Dal\DataSource::getConnection();
            $stmt = $conn->prepare('CALL user_insert(:pfirst_name, :plast_name, :pcountry, :pemail, :ppassword)');
            $stmt->bindValue(':pfirst_name', $User->getFirstName());
            $stmt->bindValue(':plast_name', $User->getLastName());
            $stmt->bindValue(':pemail', $User->getEmail());
            $stmt->bindValue(':pcountry', $User->getCountry());
            $stmt->bindValue(':ppassword', password_hash($User->getPassword(), PASSWORD_DEFAULT));
            $result = $stmt->execute();
            if ($result) {
                $message = 'User created succesfully';
            }
        } catch (\PDOException $e) {
            if ($e->getCode() == 23000) {
                $message = 'E-mail adress already in use';
            }
        }
        return $message;
    }

    public static function update($User)
    {
        $message = NULL;
        try {
            $conn = \ShoppingApp\Dal\DataSource::getConnection();
            $stmt = $conn->prepare('CALL user_update(:pId, :pFirstName, :pLastName, :pCountry, :pEmail)');
            $stmt->bindValue(':pId', $User->getUserId(), \PDO::PARAM_INT);
            $stmt->bindValue(':pFirstName', $User->getFirstName(), \PDO::PARAM_STR);
            $stmt->bindValue(':pLastName', $User->getLastName(), \PDO::PARAM_STR);
            $stmt->bindValue(':pCountry', $User->getCountry(), \PDO::PARAM_STR);
            $stmt->bindValue(':pEmail', $User->getEmail(), \PDO::PARAM_STR);
            $result = $stmt->execute();
            if ($result) {
                $message = 'Userinfo succesfully updated';
            }
        } catch (\PDOException $e) {
            if ($e->getCode() == 23000) {
                $message = 'E-mail adress already in use';
            }
        }
        return $message;
    }

    public static function selectOne($id)
    {
        $result = NULL;
        try {
            $conn = \ShoppingApp\Dal\DataSource::getConnection();
            $stmt = $conn->prepare('CALL user_select_one(:pId)');
            $stmt->bindValue(':pId', $id);
            $stmt->execute();
            $result = $stmt->fetch();
            $User = new \ShoppingApp\Bo\User();
            $User->setUserId($result['user_id']);
            $User->setFirstName($result['first_name']);
            $User->setLastName($result['last_name']);
            $User->setEmail($result['email']);
            $User->setCountry($result['country']);
            $result = $User;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
        return $result;
    }

    public static function selectAll()
    {
        $result = array();
        try {
            $conn = \ShoppingApp\Dal\DataSource::getConnection();
            $stmt = $conn = $conn->prepare('CALL user_select_all()');
            $stmt->execute();
            $array = $stmt->fetchAll();
            foreach ($array as $row) {
                $User = new \ShoppingApp\Bo\User();
                $User->setUserId($row['user_id']);
                $User->setFirstName($row['first_name']);
                $User->setLastName($row['last_name']);
                $User->setEmail($row['email']);
                $User->setCountry($row['country']);
                $result[] = $User;
            }
        } catch (\PDOExcepton $e) {
            echo $e->getMessage();
        }
        return $result;
    }

    public static function checkPassword($email, $password)
    {
        $result = NULL;
        try {
            $conn = \ShoppingApp\Dal\DataSource::getConnection();
            $stmt = $conn->prepare('CALL user_check_password(:pEmail)');
            $stmt->bindValue(':pEmail', $email);
            $stmt->execute();
            $result = $stmt->fetch();
            $result = password_verify($password, $result['password']);
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
        return $result;
    }

    public static function delete($id)
    {
        try {
            $conn = \ShoppingApp\Dal\DataSource::getConnection();
            $stmt = $conn->prepare('CALL user_delete(:pId)');
            $stmt->bindValue(':pId', $id);
            $stmt->execute();
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function addFriend($UserId, $FriendId)
    {
        $message = NULL;
        try {
            $conn = \ShoppingApp\Dal\DataSource::getConnection();
            // checked of de user al bestaat de stored procedure telt de hoevelheid rijen er overeen komen.
            $stmtCheck = $conn->prepare('CALL user_friend_check(:pUserId, :pFriendId)');
            $stmtCheck->bindValue(':pUserId', $UserId);
            $stmtCheck->bindValue(':pFriendId', $FriendId);
            $stmtCheck->execute();
            $check = $stmtCheck->fetch(); // telt het aantal rijen
            if ($check[0] == 1) {
                $message = 'You are already friends';
            } else {
                // insert de 2 id's in de tussentabel
                $stmt = $conn->prepare('CALL user_add_friend(:pUserId, :pFriendId)');
                $stmt->bindValue(':pUserId', $UserId);
                $stmt->bindValue(':pFriendId', $FriendId);
                $result = $stmt->execute();
                if ($result) {
                    // insert bidirectioneel. zodat de invitee ook bevriend is met de inviter
                    $stmt = $conn->prepare('CALL user_add_friend(:pUserId, :pFriendId)');
                    $stmt->bindValue(':pUserId', $FriendId);
                    $stmt->bindValue(':pFriendId', $UserId);
                    $result = $stmt->execute();
                    if ($result) {
                        echo 'succesfully added as friend';
                    }
                }
            }
        } catch (\PDOException $e) {
            if ($e->getCode() == 23000) {
                $message = 'E-mail adress already in use';
            }
        }
        return $message;
    }
} 