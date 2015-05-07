<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 2/05/2015
 * Time: 17:09
 */

namespace ShoppingApp\Model;
use ShoppingApp\Bo\RecipeCategory as RecipeCategory;
include_once '../../vendor/autoload.php';

$rc = new RecipeCategory();

/*$rc->setRecipeCategoryName('makkelijk');
$rc->setRecipeCategoryDescription('zeker doen');
echo DaRecipeCategory::insert($rc);*/

//echo DaRecipeCategory::delete(3);

/*$rc->setRecipeCategoryId(1);
$rc->setRecipeCategoryName('avond maal');
$rc->setRecipeCategoryDescription('niet gemakkelijk');
echo DaRecipeCategory::update($rc);*/


$rc = DaRecipeCategory::selectOne(2);
echo $rc->getRecipeCategoryName();
echo $rc->getRecipeCategoryDescription();

/*$rcs = DaRecipeCategory::selectAll();
print_r(array_values($rcs));*/
