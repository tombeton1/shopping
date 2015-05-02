<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 2/05/2015
 * Time: 14:15
 */

namespace ShoppingApp\Dal;
use ShoppingApp\Bo\ProductCategory as ProductCategory;

include_once '../../vendor/autoload.php';


$productCategory = new ProductCategory();


//$productCategory->setProductCategoryName('Eenvoudig avond maal');
//$productCategory->setProductCategoryDescription('snel klaar');
//echo DaProductCategory::insert($productCategory);

//echo DaProductCategory::delete(4);


/*$productCategory = new ProductCategory();
$productCategory->setProductCategoryId('3');
$productCategory->setProductCategoryName('avondmaal maar echt slecht');
$productCategory->setProductCategoryDescription('snel klaar');
echo DaProductCategory::update($productCategory);*/

$productCategory = DaProductCategory::selectOne(1);
echo 'dit is een :' . $productCategory->getProductCategoryName();
echo $productCategory->getProductCategoryDescription();

/*$productCategorys = DaProductCategory::selectAll();
print_r(array_values($productCategorys));*/

