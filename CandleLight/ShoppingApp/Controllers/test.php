<?php
/**
 * Created by PhpStorm.
 * User: lenny
 * Date: 25/04/15
 * Time: 21:09
 */
include_once '../../vendor/autoload.php';
$email = $_POST['email'];
$password = $_POST['password'];
$login = new \ShoppingApp\Model\MoUser();
if($login->checkPassword($email, $password)){

} else {
    $_SESSION['message'] = 'error';
    header("Location: ../View/index.php");

}
