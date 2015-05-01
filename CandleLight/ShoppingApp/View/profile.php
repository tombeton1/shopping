<?php
session_start();
$user = NULL;
if(isset($_SESSION['user']) != NULL) {
    $user =   $_SESSION['user'];
} else {
    $_SESSION['message'] = 'not logged in';
    header("Location: ../View/index.php");
    die();
}
?>
<!DOCTYPE HTML>
<html>
<head>
  <title></title>
</head>
<body>
    <h1>hello <?=$user?></h1>
</body>
</html> 