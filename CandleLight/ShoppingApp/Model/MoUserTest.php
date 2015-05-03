<?php
include_once '../../vendor/autoload.php';

  $users = new  \ShoppingApp\Model\MoUser();
    echo $users->selectAllUsers();
?>
