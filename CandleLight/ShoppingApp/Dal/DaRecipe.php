<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 26/04/2015
 * Time: 16:00
 */

namespace ShoppingApp\Dal;


use ShoppingApp\Bo\Recipe;

class DaRecipe {

    public static function insert($recipe)
    {

        try {
            $conn = \ShoppingApp\Dal\DataSource::getConnection();
            $stmt = $conn->prepare('CALL recipe_insert(:pRecipeCategory, :pRecipeName, :pRecipeAmount, :pAmountUnit, :pRecipeAmountUnit, :pRecipeText)');
            $stmt->bindValue(':pRecipeCategory', $recipe->getRecipeCategory(), \PDO::PARAM_INT);
            $stmt->bindValue(':pRecipeName', $recipe->getRecipeName(), \PDO::PARAM_STR);
            $stmt->bindValue(':pRecipeAmount', $recipe->getRecipeAmount());
            $stmt->bindValue(':pRecipeAmountUnit', $recipe->getRecipeAmountUnit(), \PDO::PARAM_STR);
            $stmt->bindValue(':pProductDescription', $recipe->getRecipeText(), \PDO::PARAM_STR);
            $stmt->execute();

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function delete($recipe)
    {
        $recipe = new Recipe();
        try {
            $conn = \ShoppingApp\Dal\DataSource::getConnection();
            $stmt = $conn->prepare('CALL recipe_delete(:pId)');
            $stmt->bindValue(':pId', $recipe->getRecipeId());
            $stmt->execute();
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function update($recipe)
    {

        try {
            $conn = \ShoppingApp\Dal\DataSource::getConnection();
            $stmt = $conn->prepare('CALL recipe_update(:pId, :pRecipeCategory, :pRecipeName, :pRecipeAmount, :pAmountUnit, :pRecipeAmountUnit, :pRecipeText)');
            $stmt->bindValue(':pId', $recipe->getRecipeId(), \PDO::PARAM_INT);
            $stmt->bindValue(':pRecipeCategory', $recipe->getRecipeCategory(), \PDO::PARAM_INT);
            $stmt->bindValue(':pRecipeName', $recipe->getRecipeName(), \PDO::PARAM_STR);
            $stmt->bindValue(':pRecipeAmount', $recipe->getRecipeAmount());
            $stmt->bindValue(':pRecipeAmountUnit', $recipe->getRecipeAmountUnit(), \PDO::PARAM_STR);
            $stmt->bindValue(':pProductDescription', $recipe->getRecipeText(), \PDO::PARAM_STR);
            $stmt->execute();

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function selectOne($recipe){
        $recipe = new Recipe();
        try {
            $conn = \ShoppingApp\Dal\DataSource::getConnection();
            $stmt = $conn->prepare('CALL recipe_select_one(:pId)');
            $stmt->bindValue(':pId', $recipe->getRecipeId());
            $stmt->execute();
            $array = $stmt->fetch(\PDO::FETCH_ASSOC);
            $recipe->setRecipeId($array['recipe_id']);
            $recipe->setRecipeCategory($array['recipe_category_id']);
            $recipe->setRecipeName($array['recipe_name']);
            $recipe->setRecipeAmount($array['recipe_amount']);
            $recipe->setRecipeAmountUnit($array['recipe_amount_unit']);
            $recipe->setRecipeText($array['recipe_text']);

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }


}