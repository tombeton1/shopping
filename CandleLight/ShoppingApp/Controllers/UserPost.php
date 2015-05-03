<?php
/**
 * Created by PhpStorm.
 * User: lenny
 * Date: 03/05/15
 * Time: 18:44
 */

namespace ShoppingApp\Controllers;

include_once '../../vendor/autoload.php';


$Users = new \ShoppingApp\Model\MoUser();
$Users->insertUser($_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['password'], $_POST['country']);