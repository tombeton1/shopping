<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 25/04/2015
 * Time: 15:27
 */

namespace ShoppingApp\Dal;

use ShoppingApp\Bo\Product;

class DaProduct
{

    public static function insert($product)
    {

        try {
            $conn = \ShoppingApp\Dal\DataSource::getConnection();
            $stmt = $conn->prepare('CALL product_insert(:pProductCategory, :pProductName, :pProductPrice, :pProductDescription)');
            $stmt->bindValue(':pProductCategory', $product->getProductCategory(), \PDO::PARAM_INT);
            $stmt->bindValue(':pProductName', $product->getProductName(), \PDO::PARAM_STR);
            $stmt->bindValue(':pProductPrice', $product->getProductPrice(), \PDO::PARAM_STR);
            $stmt->bindValue(':pProductDescription', $product->getProductDescription(), \PDO::PARAM_STR);
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

    public static function delete($product)
    {

        try {
            $conn = \ShoppingApp\Dal\DataSource::getConnection();
            $stmt = $conn->prepare('CALL product_delete(:pId)');
            $stmt->bindValue(':pId', $product->getProductId());
            $stmt->execute();
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function update($product)
    {
        try {
            $conn = \ShoppingApp\Dal\DataSource::getConnection();
            $stmt = $conn->prepare('CALL product_update(:pId, :pProductCategory, :pProductName, :pProductPrice, :pProductDescription)');
            $stmt->bindValue(':pId', $product->getProductId(), \PDO::PARAM_INT);
            $stmt->bindValue(':pProductCategory', $product->getProductCategory(), \PDO::PARAM_INT);
            $stmt->bindValue(':pProductName', $product->getProductName(), \PDO::PARAM_STR);
            $stmt->bindValue(':pProductPrice', $product->getProductPrice(), \PDO::PARAM_STR);
            $stmt->bindValue(':pProductDescription', $product->getProductDescription(), \PDO::PARAM_STR);
            $stmt->execute();

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function selectOne($product){

        try {
            $conn = \ShoppingApp\Dal\DataSource::getConnection();
            $stmt = $conn->prepare('CALL product_select_one(:pId)');
            $stmt->bindValue(':pId', $product->getProductId());
            $stmt->execute();
            $array = $stmt->fetch(\PDO::FETCH_ASSOC);
            $product->setProductId($array['product_id']);
            $product->setProductCategory($array['product_category_id']);
            $product->setProductName($array['product_name']);
            $product->setProductPrice($array['product_price']);
            $product->setProductDescription($array['product_description']);

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function selectAll(){
        $result = false;
        $conn = \ShoppingApp\Dal\DataSource::getConnection();
        $stmt = $conn->prepare('CALL product_select_all()');
        $stmt->execute();
        $row =$stmt->rowCount();
       print_r($row) ;

    }

}