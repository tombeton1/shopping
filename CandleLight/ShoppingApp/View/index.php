<?php
session_start();
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
        <form class="form">
            <input type="text" placeholder="Username">
            <input type="password" placeholder="Password">
            <button type="submit" id="login-button">Login</button>
        </form>
    </div>
</div>
<script type="text/javascript">
    $("#login-button").click(function(event){
        event.preventDefault();
        $('form').fadeOut(500);
        $('.wrapper').addClass('form-success');
    });
</script>
</body>
</html>