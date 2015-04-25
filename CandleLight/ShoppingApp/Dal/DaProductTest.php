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
//$product->setProductCategory('2');
//$product->setProductName('product2');
//$product->setProductPrice('Super, 60');
//$product->setProductDescription('blal lalal  alla llallalal');
//DaProduct::insert($product);


//$product->setProductId(1);
//DaProduct::delete($product);

//$product->setProductId('3');
//$product->setProductCategory('2');
//$product->setProductName('product Updated');
//$product->setProductPrice('Super, 60');
//$product->setProductDescription('blal lalal  alla llallalal');
//DaProduct::update($product);

$product->setProductId('2');
DaProduct::selectOne($product);
echo 'dit is the ' . $product->getProductName();
