<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 25/04/2015
 * Time: 15:27
 */

namespace ShoppingApp\Dal;
use ShoppingApp\Bo\Product as Product;

class DaProduct
{

    public static function insert($productIn)
    {
        $product = new Product();

        try {
            $conn = \ShoppingApp\Dal\DataSource::getConnection();
            $stmt = $conn->prepare('CALL product_insert(:pProductCategory, :pProductName, :pProductPrice, :pProductDescription)');
            $stmt->bindValue(':pProductCategory', $product->getProductCategory($productIn), \PDO::PARAM_INT);
            $stmt->bindValue(':pProductName', $product->getProductName($productIn), \PDO::PARAM_STR);
            $stmt->bindValue(':pProductPrice', $product->getProductPrice($productIn), \PDO::PARAM_STR);
            $stmt->bindValue(':pProductDescription', $product->getProductDescription($productIn), \PDO::PARAM_STR);
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