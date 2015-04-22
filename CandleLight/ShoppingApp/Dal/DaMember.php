<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 21/04/2015
 * Time: 23:26
 */

namespace ShoppingApp\Dal;

class DaMember
{

    public function insertMember($member)
    {
        try {

            $conn = DataSource::getConnection();
            $stmt = $conn->prepare('INSERT into members(first_name,email,telephone)VALUES (:first_name,:email,:telephone)');
            $stmt->bindValue(':first_name', $member->firstName);
            $stmt->bindValue(':email', $member->email);
            $stmt->bindValue(':telephone', $member->telephone);
            $stmt->execute();

        } catch (\PDOException $e) {

        }
    }

}