<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 26/04/2015
 * Time: 17:23
 */

namespace ShoppingApp\Dal;


use ShoppingApp\Bo\RecipeCategory;

class DaRecipeCategory {

    public static function insert($recipeCategory)
    {

        try {
            $conn = \ShoppingApp\Dal\DataSource::getConnection();
            $stmt = $conn->prepare('CALL recipe_category_insert(:pRecipeCategoryName, :pRecipeCategoryDescription )');
            $stmt->bindValue(':pRecipeCategoryName', $recipeCategory->getRecipeCategoryName(), \PDO::PARAM_STR);
            $stmt->bindValue(':pRecipeCategoryDescription', $recipeCategory->getRecipeCategoryDescription(), \PDO::PARAM_STR);
            $stmt->execute();

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function delete($recipeCategory)
    {

        try {
            $conn = \ShoppingApp\Dal\DataSource::getConnection();
            $stmt = $conn->prepare('CALL recipe_category_delete(:pId)');
            $stmt->bindValue(':pId', $recipeCategory->getRecipeCategoryId());
            $stmt->execute();
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function update($recipeCategory)
    {

        try {
            $conn = \ShoppingApp\Dal\DataSource::getConnection();
            $stmt = $conn->prepare('CALL recipe_category_update(:pId, :pRecipeCategoryName, :pRecipeCategoryDescription )');
            $stmt->bindValue(':pId', $recipeCategory->getRecipeCategoryId(), \PDO::PARAM_INT);
            $stmt->bindValue(':pRecipeCategoryName', $recipeCategory->getRecipeCategoryName(), \PDO::PARAM_STR);
            $stmt->bindValue(':pRecipeCategoryDescription', $recipeCategory->getRecipeCategoryDescription(), \PDO::PARAM_STR);
            $stmt->execute();

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function selectOne($recipeCategory){

        try {
            $conn = \ShoppingApp\Dal\DataSource::getConnection();
            $stmt = $conn->prepare('CALL recipe_category_select_one(:pId)');
            $stmt->bindValue(':pId', $recipeCategory->getRecipeCategoryId());
            $stmt->execute();
            $array = $stmt->fetch(\PDO::FETCH_ASSOC);
            $recipeCategory->setRecipeCategoryName($array['recipe_category_name']);
            $recipeCategory->setRecipeCategoryDescription($array['recipe_category_desciption']);

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

}