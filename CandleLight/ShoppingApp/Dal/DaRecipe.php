<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 26/04/2015
 * Time: 16:00
 */

namespace ShoppingApp\Dal;


use ShoppingApp\Bo\ProductCategory;
use ShoppingApp\Bo\Recipe;

class DaRecipe
{

    public static function insert($recipe)
    {
        $message = null;
        $recipe = new Recipe();
        try {
            $conn = \ShoppingApp\Dal\DataSource::getConnection();
           // $stmt = $conn->prepare('insert into recipe (recipe_category_id, recipe_name, recipe_amount, recipe_amount_unit, recipe_text) VALUES (?,?,?,?,?)');

            $stmt = $conn->prepare('CALL recipe_insert(:pRecipeCategory, :pRecipeName, :pRecipeAmount, :pRecipeAmountUnit, :pRecipeText');
            $stmt->bindValue(':pRecipeCategory', $recipe->getRecipeCategory());
            $stmt->bindValue(':pRecipeName', $recipe->getRecipeName(), \PDO::PARAM_STR);
            $stmt->bindValue(':pRecipeAmount', $recipe->getRecipeAmount());
            $stmt->bindValue(':pRecipeAmountUnit', $recipe->getRecipeAmountUnit(), \PDO::PARAM_STR);
            $stmt->bindValue(':pRecipeText', $recipe->getRecipeText(), \PDO::PARAM_STR);
            $result = $stmt->execute();
            if ($result) {
                $message = 'New recipe created';
            }
        } catch (\PDOException $e) {
            if ($e->getCode() == 23000) {
                $message = 'Recipe already exist';
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
            $stmt = $conn->prepare('CALL recipe_delete(:pId)');
            $stmt->bindValue(':pId', $id);
            $result = $stmt->execute();
            if ($result) {
                $message = 'Recipe removed';
            }
        } catch (\PDOException $e) {
            $message = $e->getMessage();
        }
        return $message;
    }

    public static function update($recipe)
    {
        $message = null;
        try {
            $conn = \ShoppingApp\Dal\DataSource::getConnection();
            $stmt = $conn->prepare('CALL recipe_update(:pId, :pRecipeCategory, :pRecipeName, :pRecipeAmount, :pAmountUnit, :pRecipeAmountUnit, :pRecipeText)');
            $stmt->bindValue(':pId', $recipe->getRecipeId(), \PDO::PARAM_INT);
            $stmt->bindValue(':pRecipeCategory', $recipe->getRecipeCategory(), \PDO::PARAM_INT);
            $stmt->bindValue(':pRecipeName', $recipe->getRecipeName(), \PDO::PARAM_STR);
            $stmt->bindValue(':pRecipeAmount', $recipe->getRecipeAmount());
            $stmt->bindValue(':pRecipeAmountUnit', $recipe->getRecipeAmountUnit(), \PDO::PARAM_STR);
            $stmt->bindValue(':pProductDescription', $recipe->getRecipeText(), \PDO::PARAM_STR);
            $result = $stmt->execute();
            if ($result) {
                $message = 'Recipe updated';
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
            $stmt = $conn->prepare('CALL recipe_select_one(:pId)');
            $stmt->bindValue(':pId', $id);
            $stmt->execute();
            $result = $stmt->fetch();
            $recipe = new Recipe();
            $recipeCategory = new ProductCategory();
            $recipe->setRecipeId($result['recipe_id']);
            $recipe->setRecipeCategory($result['recipe_category_id']);
            $recipe->setRecipeName($result['recipe_name']);
            $recipe->setRecipeAmount($result['recipe_amount']);
            $recipe->setRecipeAmountUnit($result['recipe_amount_unit']);
            $recipe->setRecipeText($result['recipe_text']);
            $recipeCategory->setProductCategoryId($result['product_category_id']);
            $recipeCategory->setProductCategoryName($result['product_category_name']);
            $recipeCategory->setProductCategoryDescription($result['product_category_description']);
            $recipe->setRecipeCategory($recipeCategory);
            $result = $recipe;

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

        return $result;
    }

    public static function selectAll()
    {
        $result = array();
        try {

            $conn = \ShoppingApp\Dal\DataSource::getConnection();
            $stmt = $conn->prepare('CALL recipe_select_all()');
            $stmt->execute();
            $array = $stmt->fetchAll();
            foreach ($array as $row) {
                $recipe = new Recipe();
                $recipeCategory = new ProductCategory();
                $recipe->setRecipeId($result['recipe_id']);
                $recipe->setRecipeCategory($result['recipe_category_id']);
                $recipe->setRecipeName($result['recipe_name']);
                $recipe->setRecipeAmount($result['recipe_amount']);
                $recipe->setRecipeAmountUnit($result['recipe_amount_unit']);
                $recipe->setRecipeText($result['recipe_text']);
                $recipeCategory->setProductCategoryId($result['product_category_id']);
                $recipeCategory->setProductCategoryName($result['product_category_name']);
                $recipeCategory->setProductCategoryDescription($result['product_category_description']);
                $recipe->setRecipeCategory($recipeCategory);
                $result [] = $recipe;

            }
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
        return $result;

    }

}