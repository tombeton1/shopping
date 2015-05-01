<?php
include_once '../../vendor/autoload.php';

$email = $_POST['email'];
$password = $_POST['password'];
$controller = new \ShoppingApp\Controllers\Login($email, $password);
$controller->checkLogin();
?>
