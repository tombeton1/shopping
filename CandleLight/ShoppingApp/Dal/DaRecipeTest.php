<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 1/05/2015
 * Time: 20:41
 */

namespace ShoppingApp\Dal;

use ShoppingApp\Bo\Recipe as Recipe;

include_once '../../vendor/autoload.php';


   $recipe = new Recipe();

$recipe->setRecipeCategory(1);
$recipe->setRecipeName('recipe 2');
$recipe->setRecipeAmount(5);
$recipe->setRecipeAmountUnit('liter');
$recipe->setRecipeText('blalaldladldaldadla');
echo DaRecipe::insert($recipe);



//echo DaRecipe::delete(1);

//$recipe->setRecipeId('3');
//$recipe->setRecipeCategory(1);
//$recipe->setRecipeName('aarbeien');
//$recipe->setRecipeAmount(5);
//$recipe->setRecipeText('mqsdlmqsdklmdsql');
//echo DaRecipe::update($recipe);

//print_r( DaRecipe::selectOne(3));

//$recipes = DaRecipe::selectAll();
//print_r(array_values($recipes));




