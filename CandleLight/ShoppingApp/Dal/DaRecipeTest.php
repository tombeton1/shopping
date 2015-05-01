<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 1/05/2015
 * Time: 20:41
 */

namespace ShoppingApp\Dal;
use ShoppingApp\Bo\RecipeCategory;
use ShoppingApp\Bo\Recipe as Recipe;

include_once '../../vendor/autoload.php';


   $recipe = new Recipe();

//$recipe->setRecipeCategory('1');
//$recipe->setRecipeName('recipe 2');
//$recipe->setRecipeAmount('5');
//$recipe->setRecipeAmountUnit('liter');
//$recipe->setRecipeText('blalaldladldaldadla');
//echo DaRecipe::insert($recipe);

//:pRecipeCategory, :pRecipeName, :pRecipeAmount, :pAmountUnit, :pRecipeText '

echo DaRecipe::delete(1);