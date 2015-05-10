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
$app->get('/logout/', function () {
   \ShoppingApp\Controllers\Authentication::logout();
});
$app->get('/api/users', 'getUsers');
$app->get('/api/users/:id', 'getUser');
$app->run();
function getUsers(){
    $controller = new \ShoppingApp\Controllers\User();
    echo ($controller->getUsers());
}
function getUser($id){
    $controller = new \ShoppingApp\Controllers\User();
    echo ($controller->getUser($id));
}

?>
