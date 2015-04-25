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

        try {
            $conn = \ShoppingApp\Dal\DataSource::getConnection();
            $stmt = $conn->prepare('CALL product_insert(:pProductCategory, :pProductName, :pProductPrice, :pProductDescription)');
            $stmt->bindValue(':pProductCategory', $productIn->getProductCategory(), \PDO::PARAM_INT);
            $stmt->bindValue(':pProductName', $productIn->getProductName(), \PDO::PARAM_STR);
            $stmt->bindValue(':pProductPrice', $productIn->getProductPrice(), \PDO::PARAM_STR);
            $stmt->bindValue(':pProductDescription', $productIn->getProductDescription(), \PDO::PARAM_STR);
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

    public static function delete($productOut){

        try{
            $conn = \ShoppingApp\Dal\DataSource::getConnection();
            $stmt = $conn->prepare('CALL product_delete(pId)');
            $stmt->bindValue('pId', $productOut->getProductId());
        }catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }
}