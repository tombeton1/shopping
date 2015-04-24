<?php
/**
 * Created by PhpStorm.
 * User: lenny
 * Date: 24/04/15
 * Time: 21:39
 */

namespace ShoppingApp\Dal;


class DaUser {

    public static function insert($User)
    {
        try {
            $conn = \ShoppingApp\Dal\DataSource::getConnection();
            $stmt = $conn->prepare('CALL user_insert(:pfirst_name, :plast_name, :pcountry, :pemail, :ppassword)');
            $stmt->bindValue(':pfirst_name', $User->getFirstName(), \PDO::PARAM_STR);
            $stmt->bindValue(':plast_name', $User->getLastName(), \PDO::PARAM_STR);
            $stmt->bindValue(':pemail', $User->getEmail(), \PDO::PARAM_STR);
            $stmt->bindValue(':pcountry', $User->getCountry(), \PDO::PARAM_STR);
            $stmt->bindValue(':ppassword', password_hash($User->getPassword(), PASSWORD_DEFAULT), \PDO::PARAM_STR);
            $result = $stmt->execute();
            if ($result) {
                echo 'succes';
            } else {
                echo 'Query/Stored Procedure syntax error';
            }
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }
} 