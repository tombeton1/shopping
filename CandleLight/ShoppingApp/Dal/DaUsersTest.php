<?php
/**
 * Created by PhpStorm.
 * User: lenny
 * Date: 24/04/15
 * Time: 21:44
 */
namespace ShoppingApp\Dal;
include_once '../../vendor/autoload.php';

//$User = new \ShoppingApp\Bo\User();
//$User->setFirstName('test');
//$User->setLastName('test');
//$User->setEmail('test@test');
//$User->setCountry('belgie');
//$User->setPassword('testz');
//\ShoppingApp\Dal\DaUser::insert($User);

$User = new \ShoppingApp\Bo\User();
$User->setUserId(1);
$User->setFirstName('ble');
$User->setLastName('ddd');
$User->setEmail('dsdd@ddd');
$User->setCountry('dsdds');
\ShoppingApp\Dal\DaUser::update($User);
