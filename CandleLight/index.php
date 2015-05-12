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
$app->put('/api/users/:id', 'updateUser');
$app->post('/api/users', 'insertUser');
$app->run();
function getUsers(){
    $controller = new \ShoppingApp\Controllers\User();
    echo ($controller->getUsers());
}
function getUser($id){
    $controller = new \ShoppingApp\Controllers\User();
    echo ($controller->getUser($id));
}
function updateUser($id){
    $User = new ShoppingApp\Bo\User();
    $request = Slim::getInstance()->request();
    $User->setUserId($id);
    $User->setFirstName($request->put('first-name'));
    $User->setLastName($request->put('last-name'));
    $User->setCountry($request->put('country'));
    $User->setEmail($request->put('email'));
    $controller = new \ShoppingApp\Controllers\User();
    echo ($controller->updateUser($User));
}
function insertUser(){
    $User = new ShoppingApp\Bo\User();
    $request = Slim::getInstance()->request();
    $User->setFirstName($request->post('first-name'));
    $User->setLastName($request->post('last-name'));
    $User->setCountry($request->post('country'));
    $User->setEmail($request->post('email'));
    $User->setPassword($request->post('password'));
    $controller = new \ShoppingApp\Controllers\User();
    echo ($controller->insert($User));
}

