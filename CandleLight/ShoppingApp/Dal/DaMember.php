<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 21/04/2015
 * Time: 23:26
 */

namespace ShoppingApp\Dal;
include_once '../../vendor/autoload.php';

class DaMember
{


    /**
     * @param $member
     */
    public static function insertMember($member)
    {

        try {
            $conn = \ShoppingApp\Dal\DataSource::getConnection();
            $stmt = $conn->prepare('INSERT into member(first_name, email)VALUES (:first_name,:email)');
            $stmt->bindValue(':first_name', $member->getFirstName());
            $stmt->bindValue(':email', $member->getEmail());
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