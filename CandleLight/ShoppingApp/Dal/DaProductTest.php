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
//$product->setProductCategory('1');
//$product->setProductName('product1');
//$product->setProductPrice('Aldi, 10');
//$product->setProductDescription('blal lalal  alla llallalal');
//DaProduct::insert($product);


$product->setProductId(1);
DaProduct::delete($product);




