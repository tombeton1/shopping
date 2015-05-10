<?php
require_once '../../vendor/autoload.php';
$klein = new \Klein\Klein();

$klein->respond('POST', '/users', function () {
    return 'hello';
});

$klein->dispatch();
?>
