<?php
session_start();
$message = '';
if(!isset($_SESSION['message'])) {
    $message = '';
} else {
    $message =  $_SESSION['message'];
}
$token = hash('sha512', uniqid(rand(), TRUE));
$_SESSION['token'] = $token;
$_SESSION['token_time'] = time();
if (!isset($_SESSION['token'])){
    $_SESSION['token'] = hash('sha512', uniqid(rand(), TRUE));
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
        <form class="form" method="POST" action="routing.php">
            <input type="hidden" name="token" value="<?php echo $token; ?>" />
            <input type="text" name="email" placeholder="E-mail">
            <input type="password" name="password" placeholder="Password">
            <label><?=$message?></label><br>
            <button type="submit" name="action" value="login" id="login-button">Login</button>
        </form>
    </div>
</div>
</body>
</html>