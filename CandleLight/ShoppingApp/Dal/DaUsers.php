<?php
/**
 * Created by PhpStorm.
 * User: lenny
 * Date: 24/04/15
 * Time: 21:39
 */

namespace ShoppingApp\Dal;


class DaUsers {

    public static function insert($user)
    {

        try {
            $conn = \ShoppingApp\Dal\DataSource::getConnection();
            $stmt = $conn->prepare('CALL users_insert(@puser_id, :pfirst_name, :plast_name, :pemail, :pcountry, :ppassword)');
            $stmt->bindValue(':pfirst_name', $user->getFirstName());
            $stmt->bindValue(':plast_name', $user->getLastName());
            $stmt->bindValue(':pemail', $user->getEmail());
            $stmt->bindValue(':pcountry', $user->getContry());
            $stmt->bindValue(':ppassword', $user->getPassword());
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