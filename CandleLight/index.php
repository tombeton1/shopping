<?php
include_once "vendor/autoload.php";
use Slim\Slim;
$app = new Slim();
$app->get('/', function () use ($app) {
    $app->render('index.php');
});
$app->post('/login', function() use($app){
    $token = $app->request->post('token');
    $email = $app->request->post('email');
    $password = $app->request->post('password');
    $controller = new \ShoppingApp\Controllers\Authentication($token, $email, $password);
    $controller->login();
});
$app->get('/app/', function () use ($app){
    $app->render('shoppingapp.php');
});
$app->run();
?>
