<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 26/04/2015
 * Time: 17:54
 */

namespace ShoppingApp\Dal;

use ShoppingApp\Bo\ProductCategory;

include_once '../../vendor/autoload.php';

class DaProductCategory
{

    public static function insert($productCategory)
    {
        $message = null;
        try {
            $conn = \ShoppingApp\Dal\DataSource::getConnection();
            $stmt = $conn->prepare('CALL product_category_insert(:pProductCategoryName, :pProductCategoryDescription )');
            $stmt->bindValue(':pProductCategoryName', $productCategory->getProductCategoryName(), \PDO::PARAM_STR);
            $stmt->bindValue(':pProductCategoryDescription', $productCategory->getProductCategoryDescription(), \PDO::PARAM_STR);
            $result = $stmt->execute();
            if ($result) {
                $message = 'New category created';
            }
        } catch (\PDOException $e) {
            if ($e->getCode() == 23000) {
                $message = 'Category already exist';
            } else {
                $message = $e->getMessage();
            }
        }
        return $message;
    }

    public static function delete($id)
    {
            $message= null;
        try {
            $conn = \ShoppingApp\Dal\DataSource::getConnection();
            $stmt = $conn->prepare('CALL product_category_delete(:pId)');
            $stmt->bindValue(':pId', $id);
            $result = $stmt->execute();
            if ($result) {
                $message = 'Category removed';
            }
        } catch (\PDOException $e) {
            $message = $e->getMessage();
        }
        return $message;
    }

    public static function update($productCategory)
    {
        $message = null;
        try {
            $conn = \ShoppingApp\Dal\DataSource::getConnection();
            $stmt = $conn->prepare('CALL product_category_update(:pId, :pProductCategoryName, :pProductCategoryDescription )');
            $stmt->bindValue(':pId', $productCategory->getProductCategoryId(), \PDO::PARAM_INT);
            $stmt->bindValue(':pProductCategoryName', $productCategory->getProductCategoryName(), \PDO::PARAM_STR);
            $stmt->bindValue(':pProductCategoryDescription', $productCategory->getProductCategoryDescription(), \PDO::PARAM_STR);;
            $result = $stmt->execute();
            if ($result) {
                $message = 'Category updated';
            }
        } catch (\PDOException $e) {
            $message = $e->getMessage();
        }
        return $message;

    }

    public static function selectOne($id)
    {
        $result=null;
        try {
            $conn = \ShoppingApp\Dal\DataSource::getConnection();
            $stmt = $conn->prepare('CALL product_category_select_one(:pId)');
            $stmt->bindValue(':pId', $id);
            $stmt->execute();
            $result = $stmt->fetch();
            $productCategory = new ProductCategory();
            $productCategory->setProductCategoryName($result['product_category_name']);
            $productCategory->setProductCategoryDescription($result['product_category_description']);
            $result = $productCategory;

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
        return $result;
    }

    public static function  selectAll()
    {
        $result = array();
        try {
            $conn = \ShoppingApp\Dal\DataSource::getConnection();
            $stmt = $conn->prepare('CALL product_category_select_all');
            $stmt->execute();
            $array = $stmt->fetchAll();
            foreach ($array as $row) {
                $productCategory = new ProductCategory();
                $productCategory->setProductCategoryId($row['product_category_id']);
                $productCategory->setProductCategoryName($row['product_category_name']);
                $productCategory->getProductCategoryDescription($row['product_category_description']);
                $result[] = $productCategory;
            }
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
        return $result;
    }

}