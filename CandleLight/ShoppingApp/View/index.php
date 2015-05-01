<?php
session_start();
$message = NULL;
if(isset($_SESSION['message'])) {
   $message =   $_SESSION['message'];
}
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
    <link rel="StyleSheet" type="text/css" href="css/main.css">
</head>
<body>
<div class="wrapper">
    <div class="container">
        <h1>Welcome</h1>
        <form class="form" method="POST" action="../Controllers/routes.php">
            <input type="text" name="email" placeholder="E-mail">
            <input type="password" name="password" placeholder="Password">
            <label><?=$message?></label><br>
            <button type="submit" name="submit" id="login-button">Login</button>
        </form>
    </div>
</div>
</body>
</html>