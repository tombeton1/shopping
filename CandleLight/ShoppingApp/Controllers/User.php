<?php
/**
 * Created by PhpStorm.
 * User: lenny
 * Date: 10/05/15
 * Time: 00:03
 */

namespace ShoppingApp\Controllers;
use ShoppingApp\Model\DaUser as User;


function login(){

    $user = new User();
    $email = $_POST['email'];
    $password = $_POST['password'];
    if ($_POST['token'] == $_SESSION['token']) {
        if ($user->checkPassword($email, $password)) {
            $_SESSION['user'] = $email;
            header("Location: /app/");
            die();
        } else {
            $_SESSION['message'] = 'e-mail or password is not valid';
            header("Location: /");
            die();
        }
    } else {
        $_SESSION['message'] = 'token invalid or corrupted';
        header("Location: /");
        die();
    }
}
function test(){

    echo 'test';
}