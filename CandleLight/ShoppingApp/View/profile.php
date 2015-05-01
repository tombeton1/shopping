<?php
session_start();
$user = NULL;
if(isset($_SESSION['user']) != NULL) {
    $user =   $_SESSION['user'];
} else {
    $_SESSION['message'] = 'not logged in';
    header("Location: ../View/index.php");
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
  <title></title>
</head>
<body>
    <h1>hello <?=$user?></h1>
</body>
</html> 