<?php
include_once '../../vendor/autoload.php';

if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'login':
            $controller = new \ShoppingApp\Controllers\Authentication();
            $controller->setPassword($_POST['password']);
            $controller->setEmail($_POST['email']);
            $controller->login();
        case 'logout':
            $controller = new \ShoppingApp\Controllers\Authentication();
            $controller->logout();
    }
}
?>
