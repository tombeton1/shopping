<?php
/**
 * Created by PhpStorm.
 * User: lenny
 * Date: 24/04/15
 * Time: 21:39
 */

namespace ShoppingApp\Dal;
include_once '../../vendor/autoload.php';


class DaUser {

    public static function insert($User)
    {
        $message = NULL;
        try {
            $conn = \ShoppingApp\Dal\DataSource::getConnection();
            $stmt = $conn->prepare('CALL user_insert(:pfirst_name, :plast_name, :pcountry, :pemail, :ppassword)');
            $stmt->bindValue(':pfirst_name', $User->getFirstName(), \PDO::PARAM_STR);
            $stmt->bindValue(':plast_name', $User->getLastName(), \PDO::PARAM_STR);
            $stmt->bindValue(':pemail', $User->getEmail(), \PDO::PARAM_STR);
            $stmt->bindValue(':pcountry', $User->getCountry(), \PDO::PARAM_STR);
            $stmt->bindValue(':ppassword', password_hash($User->getPassword(), PASSWORD_DEFAULT), \PDO::PARAM_STR);
            $result = $stmt->execute();
            if($result){
                $message = 'User created succesfully';
            }
        } catch (\PDOException $e) {
            if($e->getCode() == 23000) {
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
            if($result){
                $message = 'Userinfo succesfully updated';
            }
        } catch (\PDOException $e) {
            if($e->getCode() == 23000) {
                $message = 'E-mail adress already in use';
            }
        }
        return $message;
    }

    public static function selectOne($id){

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

    public static function selectAll(){

        $result = array();
        try {
            $conn = \ShoppingApp\Dal\DataSource::getConnection();
            $stmt = $conn = $conn->prepare('CALL user_select_all()');
            $stmt->execute();
            $array = $stmt->fetchAll();
            foreach($array as $row) {
                $User = new \ShoppingApp\Bo\User();
                $User->setUserId($row['user_id']);
                $User->setFirstName($row['first_name']);
                $User->setLastName($row['last_name']);
                $User->setEmail($row['email']);
                $User->setCountry($row['country']);
                $result[] = $User;
            }
        } catch(\PDOExcepton $e){

        }
        return $result;
    }
} 