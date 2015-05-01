<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 25/04/2015
 * Time: 15:27
 */

namespace ShoppingApp\Dal;

use ShoppingApp\Bo\Product;
use ShoppingApp\Bo\ProductCategory;

class DaProduct
{

    public static function insert($product)
    {
        $message = null;
        try {
            $conn = \ShoppingApp\Dal\DataSource::getConnection();
            $stmt = $conn->prepare('CALL product_insert(:pProductCategory, :pProductName, :pProductPrice, :pProductDescription)');
            $stmt->bindValue(':pProductCategory', $product->getProductCategory(), \PDO::PARAM_INT);
            $stmt->bindValue(':pProductName', $product->getProductName(), \PDO::PARAM_STR);
            $stmt->bindValue(':pProductPrice', $product->getProductPrice(), \PDO::PARAM_STR);
            $stmt->bindValue(':pProductDescription', $product->getProductDescription(), \PDO::PARAM_STR);
            $result = $stmt->execute();
            if ($result) {
                $message = 'New product created';
            }
        } catch (\PDOException $e) {
            if ($e->getCode() == 23000) {
                $message = 'Product already exist';
            } else {
                $message = $e->getMessage();
            }
        }
        return $message;
    }

    public static function delete($product)
    {
        $message = null;
        try {
            $conn = \ShoppingApp\Dal\DataSource::getConnection();
            $stmt = $conn->prepare('CALL product_delete(:pId)');
            $stmt->bindValue(':pId', $product->getProductId());
            $result = $stmt->execute();
            if ($result) {
                $message = 'Product removed';
            }
        } catch (\PDOException $e) {
            $message = $e->getMessage();
        }
        return $message;
    }

    public static function update($product)
    {
        $message = NULL;
        try {
            $conn = \ShoppingApp\Dal\DataSource::getConnection();
            $stmt = $conn->prepare('CALL product_update(:pId, :pProductCategory, :pProductName, :pProductPrice, :pProductDescription)');
            $stmt->bindValue(':pId', $product->getProductId(), \PDO::PARAM_INT);
            $stmt->bindValue(':pProductCategory', $product->getProductCategory(), \PDO::PARAM_INT);
            $stmt->bindValue(':pProductName', $product->getProductName(), \PDO::PARAM_STR);
            $stmt->bindValue(':pProductPrice', $product->getProductPrice(), \PDO::PARAM_STR);
            $stmt->bindValue(':pProductDescription', $product->getProductDescription(), \PDO::PARAM_STR);
            $result = $stmt->execute();
            if ($result) {
                $message = 'Product updated';
            }
        } catch (\PDOException $e) {
            $message = $e->getMessage();
        }
        return $message;
    }

    public static function selectOne($id)
    {
        $result = null;
        try {
            $conn = \ShoppingApp\Dal\DataSource::getConnection();
            $stmt = $conn->prepare('CALL product_select_one(:pId)');
            $stmt->bindValue(':pId', $id);
            $stmt->execute();
            $result = $stmt->fetch();
            $product = new Product();
            $productCategory = new ProductCategory();
            $product->setProductId($result['product_id']);
            $product->setProductCategory($result['product_category_id']);
            $product->setProductName($result['product_name']);
            $product->setProductPrice($result['product_price']);
            $product->setProductDescription($result['product_description']);
            $productCategory->setProductCategoryName($result['product_category_name']);
            $productCategory->setProductCategoryId($result['product_category_id']);
            $productCategory->setProductCategoryDescription($result['product_category_description']);
            $product->setProductCategory($productCategory);
            $result = $product;

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
        return $result;
    }

    public static function selectAll()
    {
        $result = array();
        $catResult = array();
        try {

            $conn = \ShoppingApp\Dal\DataSource::getConnection();
            $stmt = $conn->prepare('CALL product_select_all()');
            $stmt->execute();
            $array = $stmt->fetchAll();
            foreach ($array as $row) {
                $product = new Product();
                $productCategory =new ProductCategory();
                $product->setProductId($row['product_id']);
                $product->setProductName($row['product_name']);
                $product->setProductPrice($row['product_price']);
                $product->setProductDescription($row['product_description']);
                $productCategory->setProductCategoryName($row['product_category_name']);
                $productCategory->setProductCategoryId($row['product_category_id']);
                $productCategory->setProductCategoryDescription($row['product_category_description']);
                $product->setProductCategory($productCategory);
                $result [] = $product;

            }
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
        return $result;

    }

}