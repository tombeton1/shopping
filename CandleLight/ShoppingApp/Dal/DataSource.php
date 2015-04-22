<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 21/04/2015
 * Time: 22:53
 */


namespace ShoppingApp\Dal;

class DataSource {

     public static function getConnection() {

        $conn = NULL;
        try {
            $conn = new \PDO("mysql:host=localhost;port=3306;dbname=LennyDonnez", "root", "root");
            $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
         if($conn != 0) {
             echo 'gelukt';
         }
        return $conn;

    }
}