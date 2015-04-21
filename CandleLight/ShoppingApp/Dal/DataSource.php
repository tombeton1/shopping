<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 21/04/2015
 * Time: 22:53
 */
namespace CandleLight\ShoppingApp\Dal;
 class DataSource{
    public  function getConnection() {

        $conn = NULL;
        try {
            $conn = new PDO("mysql:host=localhost;port=3007;dbname=shopping_db", "root", "usbw");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
        return $conn;
    }
}