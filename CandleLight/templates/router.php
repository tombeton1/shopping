<?php
require '../../vendor/autoload.php';

$router = new AltoRouter();
$router->setBasePath('/CandleLight/ShoppingApp/templates/');
// map homepage
$router->map( 'GET', '/', function() {
    require 'index.php';
});

// map users details page
$router->map( 'GET|POST', '/users/[i:id]/', function( $id ) {
  require __DIR__ . '/views/user/details.php';
});

$router->map( 'GET', '/app/', function( $id ) {

  return 'test';
});