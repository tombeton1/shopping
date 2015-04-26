<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 26/04/2015
 * Time: 17:54
 */

namespace ShoppingApp\Dal;


use ShoppingApp\Bo\ProductCategory;

class DaProductCategory {

    public static function insert($productCategory)
    {

        try {
            $conn = \ShoppingApp\Dal\DataSource::getConnection();
            $stmt = $conn->prepare('CALL product_category_insert(:pProductCategoryName, :pProductCategoryDescription )');
            $stmt->bindValue(':pProductCategoryName', $productCategory->getProductCategoryName(), \PDO::PARAM_STR);
            $stmt->bindValue(':pProductCategoryDescription', $productCategory->getProductCategoryDescription(), \PDO::PARAM_STR);
            $stmt->execute();

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function delete($productCategory)
    {

        try {
            $conn = \ShoppingApp\Dal\DataSource::getConnection();
            $stmt = $conn->prepare('CALL product_category_delete(:pId)');
            $stmt->bindValue(':pId', $productCategory->getProductCategoryId());
            $stmt->execute();
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function update($productCategory)
    {

        try {
            $conn = \ShoppingApp\Dal\DataSource::getConnection();
            $stmt = $conn->prepare('CALL product_category_update(:pId, :pProductCategoryName, :pProductCategoryDescription )');
            $stmt->bindValue(':pId', $productCategory->getProductCategoryId(), \PDO::PARAM_INT);
            $stmt->bindValue(':pRecipeCategoryName', $productCategory->getProductCategoryName(), \PDO::PARAM_STR);
            $stmt->bindValue(':pRecipeCategoryDescription', $productCategory->getProductCategoryDescription(), \PDO::PARAM_STR);
            $stmt->execute();

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function selectOne($productCategory){
        $productCategory = new ProductCategory();
        try {
            $conn = \ShoppingApp\Dal\DataSource::getConnection();
            $stmt = $conn->prepare('CALL product_category_select_one(:pId)');
            $stmt->bindValue(':pId', $productCategory->getProductCategoryId());
            $stmt->execute();
            $array = $stmt->fetch(\PDO::FETCH_ASSOC);
            $productCategory->setProductCategoryName($array['product_category_name']);
            $productCategory->setProductCategoryDescription($array['product_category_description']);

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

}