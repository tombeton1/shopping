<?php
/**
 * Created by PhpStorm.
 * User: lenny
 * Date: 24/04/15
 * Time: 21:44
 */
namespace ShoppingApp\Dal;
include_once '../../vendor/autoload.php';

$User = new \ShoppingApp\Bo\User();
$User->setFirstName('test');
$User->setLastName('test');
$User->setEmail('test@test');
$User->setCountry('belgie');
$User->setPassword('testz');
\ShoppingApp\Dal\DaUser::insert($User);
