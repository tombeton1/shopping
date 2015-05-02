<?php
include_once '../../vendor/autoload.php';

if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'login':
            $email = $_POST['email'];
            $password = $_POST['password'];
            $controller = new \ShoppingApp\Controllers\Authentication($email, $password);
            $controller->checkLogin();
    }
}
?>
