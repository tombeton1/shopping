<?php
/**
 * Created by PhpStorm.
 * User: lenny
 * Date: 24/04/15
 * Time: 21:39
 */

namespace ShoppingApp\Model;


class DaUser
{
    private $conn;

    public function __construct()
    {
        $this->conn = new \ShoppingApp\Model\DataSource();
    }

    public function insert($User)
    {
        $message = NULL;
        try {
            $stmt = $this->conn->getConnection()->prepare('CALL user_insert(:pfirst_name, :plast_name, :pcountry, :pemail, :ppassword)');
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

    public function update($User)
    {
        $message = NULL;
        try {
            $stmt = $this->conn->getConnection()->prepare('CALL user_update(:pId, :pFirstName, :pLastName, :pCountry, :pEmail)');
            $stmt->bindValue(':pId', $User->getUserId());
            $stmt->bindValue(':pFirstName', $User->getFirstName());
            $stmt->bindValue(':pLastName', $User->getLastName());
            $stmt->bindValue(':pCountry', $User->getCountry());
            $stmt->bindValue(':pEmail', $User->getEmail());
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

    public function selectOne($id)
    {
        $result = NULL;
        try {

            $stmt = $this->conn->getConnection()->prepare('CALL user_select_one(:pId)');
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

    public function selectAll()
    {
        $result = array();
        try {
            $stmt = $this->conn->getConnection()->prepare('CALL user_select_all()');
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

    public function checkPassword($email, $password)
    {
        $result = NULL;
        try {
            $stmt = $this->conn->getConnection()->prepare('CALL user_check_password(:pEmail)');
            $stmt->bindValue(':pEmail', $email);
            $stmt->execute();
            $result = $stmt->fetch();
            $result = password_verify($password, $result['password']);
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
        return $result;
    }

    public function delete($id)
    {
        $message = NULL;
        try {
            $stmt = $this->conn->getConnection()->prepare('CALL user_delete(:pId)');
            $stmt->bindValue(':pId', $id);
            $result = $stmt->execute();
            if ($result) {
                $message = 'User deleted succesfully';
            }
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
        return $message;
    }

    public function addFriend($UserId, $FriendId)
    {
        $message = NULL;
        if ($UserId != $FriendId) {
            try {
                $check = $this->conn->getConnection()->prepare('CALL user_friend_check(:pUserId, :pFriendId)');
                $check->bindValue(':pUserId', $UserId);
                $check->bindValue(':pFriendId', $FriendId);
                $check->execute();
                $result = $check->fetch();
                if ($result[0] == 1) {
                    $message = 'You are already friends';
                } else {
                    $stmt = $this->conn->getConnection()->prepare('CALL user_add_friend(:pUserId, :pFriendId)');
                    $stmt->bindValue(':pUserId', $UserId);
                    $stmt->bindValue(':pFriendId', $FriendId);
                    $result = $stmt->execute();
                    if ($result) {
                        $message = 'friend added succesfully';
                    }
                }
            } catch (\PDOException $e) {
                $message = $e->getMessage();
            }
        } else {
            $message = 'UserID is the same as FriendID';
        }
        return $message;
    }

    public function acceptFriend($UserId, $FriendId)
    {
        $message = NULL;
        try {
            $stmt = $this->conn->getConnection()->prepare('CALL user_accept_friend(:pUserId, :pFriendId)');
            $stmt->bindValue(':pUserId', $UserId);
            $stmt->bindValue(':pFriendId', $FriendId);
            $result = $stmt->execute();
            if ($result) {
                $message = 'Friend request accepted';
            }
        } catch (\PDOException $e) {
            $message = $e->getMessage();
        }
        return $message;
    }

    public function selectAllFriends($UserId)
    {
        $result = array();
        try {
            $stmt = $this->conn->getConnection()->prepare('CALL user_select_all_friends(:pUserId)');
            $stmt->bindValue(':pUserId', $UserId);
            $stmt->execute();
            $array = $stmt->fetchAll();
            foreach ($array as $row) {
                $User = new \ShoppingApp\Bo\User();
                $User->setUserId($row['user_Id']);
                $User->setFirstName($row['first_name']);
                $User->setLastName($row['Last_name']);
                $User->setEmail($row['email']);
                $result[] = $User;
            }
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
        return $result;
    }

    public function searchUsers($keyword)
    {
        $result = array();
        $keyword = "%" . $keyword . "%";
        try {
            $stmt = $this->conn->getConnection()->prepare('CALL user_search(:pKeyword)');
            $stmt->bindValue(':pKeyword', $keyword);
            $stmt->execute();
            $array = $stmt->fetchAll();
            foreach ($array as $row) {
                $User = new \ShoppingApp\Bo\User();
                $User->setUserId($row['user_id']);
                $User->setFirstName($row['first_name']);
                $User->setLastName($row['last_name']);
                $User->setEmail($row['email']);
                $result[] = $User;
            }
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
        return $result;
    }
} 