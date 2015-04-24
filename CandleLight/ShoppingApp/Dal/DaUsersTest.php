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
$User->setFirstName('testerino');
$User->setLastName('testerina');
$User->setEmail('dsdfds@sfd');
$User->setCountry('belgica');
$User->setPassword('test');
\ShoppingApp\Dal\DaUser::insert($User);
