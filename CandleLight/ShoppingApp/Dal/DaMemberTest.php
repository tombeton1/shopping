<?php
/**
 * Created by PhpStorm.
 * User: lenny
 * Date: 23/04/15
 * Time: 01:05
 */
namespace ShoppingApp\Dal;
include_once '../../vendor/autoload.php';

$member = new \ShoppingApp\Bo\Member();
$member->setFirstName('test');
$member->setEmail('sdds');

echo \ShoppingApp\Dal\DaMember::insertMember($member);