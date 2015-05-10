<?php
include_once "vendor/autoload.php";
use Slim\Slim;
$app = new Slim();
$app->get('/', function () use ($app) {
    $app->render('index.php');
});
$app->run();
?>
