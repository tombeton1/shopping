<?php
/**
 * Created by PhpStorm.
 * User: lenny
 * Date: 03/05/15
 * Time: 18:01
 */

namespace ShoppingApp\Controllers;

include_once '../../vendor/autoload.php';

$users = new  \ShoppingApp\Model\DaUser();
echo $users->selectAll();