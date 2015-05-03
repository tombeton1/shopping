<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 26/04/2015
 * Time: 17:23
 */

namespace ShoppingApp\Dal;


use ShoppingApp\Bo\RecipeCategory;
include_once '../../vendor/autoload.php';

class DaRecipeCategory
{

    public static function insert($recipeCategory)
    {
        $message = null;
        try {
            $conn = \ShoppingApp\Dal\DataSource::getConnection();
            $stmt = $conn->prepare('CALL recipe_category_insert(:pRecipeCategoryName, :pRecipeCategoryDescription )');
            $stmt->bindValue(':pRecipeCategoryName', $recipeCategory->getRecipeCategoryName(), \PDO::PARAM_STR);
            $stmt->bindValue(':pRecipeCategoryDescription', $recipeCategory->getRecipeCategoryDescription(), \PDO::PARAM_STR);
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
        $message = null;
        try {
            $conn = \ShoppingApp\Dal\DataSource::getConnection();
            $stmt = $conn->prepare('CALL recipe_category_delete(:pId)');
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

    public static function update($recipeCategory)
    {
        $message = null;
        try {
            $conn = \ShoppingApp\Dal\DataSource::getConnection();
            $stmt = $conn->prepare('CALL recipe_category_update(:pId, :pRecipeCategoryName, :pRecipeCategoryDescription )');
            $stmt->bindValue(':pId', $recipeCategory->getRecipeCategoryId(), \PDO::PARAM_INT);
            $stmt->bindValue(':pRecipeCategoryName', $recipeCategory->getRecipeCategoryName(), \PDO::PARAM_STR);
            $stmt->bindValue(':pRecipeCategoryDescription', $recipeCategory->getRecipeCategoryDescription(), \PDO::PARAM_STR);
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
            $stmt = $conn->prepare('CALL recipe_category_select_one(:pId)');
            $stmt->bindValue(':pId', $id);
            $stmt->execute();
            $result = $stmt->fetch();
            $recipeCategory = new RecipeCategory();
            $recipeCategory->setRecipeCategoryId($result['recipe_category_id']);
            $recipeCategory->setRecipeCategoryName($result['recipe_category_name']);
            $recipeCategory->setRecipeCategoryDescription($result['recipe_category_description']);
            $result = $recipeCategory;

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
            $stmt = $conn->prepare('CALL recipe_category_select_all');
            $stmt->execute();
            $array = $stmt->fetchAll();
            foreach ($array as $row) {
                $recipeCategory = new RecipeCategory();
                $recipeCategory->setRecipeCategoryId($row['recipe_category_id']);
                $recipeCategory->setRecipeCategoryName($row['recipe_category_name']);
                $recipeCategory->setRecipeCategoryDescription($row['recipe_category_description']);
                $result[] = $recipeCategory;
            }
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
        return $result;
    }

}