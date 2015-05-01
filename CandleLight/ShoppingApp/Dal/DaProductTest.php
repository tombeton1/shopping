<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 25/04/2015
 * Time: 15:51
 */

namespace ShoppingApp\Dal;

use ShoppingApp\Bo\Product as Product;


include_once '../../vendor/autoload.php';

$product = new Product();

//$product->setProductId(1);
//$product->setProductCategory('1');
//$product->setProductName('product1111');
//$product->setProductPrice('Super, 60');
//$product->setProductDescription('blal lalal  alla llallalal');
//echo DaProduct::insert($product);


//$product->setProductId(9);
//echo DaProduct::delete($product);

//$product->setProductId('3');
//$product->setProductCategory('2');
//$product->setProductName('product Updated2');
//$product->setProductPrice('Super, 60');
//$product->setProductDescription('blal lalal  alla llallalal');
//echo DaProduct::update($product);


//$product = DaProduct::selectOne(7);
//echo 'dit is the ' . $product->getProductCategory()->getProductCategoryName();

$products = DaProduct::selectAll();
print_r(array_values($products));
//foreach ($products as $product) {
//    echo $product->getProductId();
//    echo $product->getProductCategory();
//    echo $product->getProductName();
//    echo $product->getProductPrice();
//    echo $product->getProductDescription();

