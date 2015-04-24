<?php
/**
 * Created by PhpStorm.
 * User: lenny
 * Date: 24/04/15
 * Time: 21:44
 */
namespace ShoppingApp\Dal;
include_once '../../vendor/autoload.php';

$user = new \ShoppingApp\Bo\Users();
$user->setFirstName('test');
$user->setC

echo \ShoppingApp\Dal\DaMember::insertMember($member);