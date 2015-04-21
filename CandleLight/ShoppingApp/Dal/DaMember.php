<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 21/04/2015
 * Time: 23:26
 */

namespace CandleLight\ShoppingApp\Dal;

class DaMember
{

    public function insertMember($member)
    {
        try {
            $conn = DataSource::getConnection();
            $stmt = $conn->prepare('INSERT into members(first_name,email,telephone)VALUES (:first_name,:email,:telephone)');
            $stmt->bindParm(':first_name', $member->firstName);
            $stmt->bindParm(':email', $member->email);
            $stmt->bindParm(':telephone', $member->telephone);

        } catch (\PDOException $e) {

        }
    }

}