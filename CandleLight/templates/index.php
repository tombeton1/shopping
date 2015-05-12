<?php
session_start();

$message = '';
if (!isset($_SESSION['message'])) {
    $message = '';
} else {
    $message = $_SESSION['message'];
}
$token = hash('sha512', uniqid(rand(), TRUE));
$_SESSION['token'] = $token;
$_SESSION['token_time'] = time();
if (!isset($_SESSION['token'])) {
    $_SESSION['token'] = hash('sha512', uniqid(rand(), TRUE));
}
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
    <link rel="StyleSheet" type="text/css" href="templates/css/main.css">
</head>
<body>
<div class="wrapper">
    <div class="container">
        <h1>Welcome</h1>

        <form class="form" method="POST" action="login">
            <input type="hidden" name="token" value="<?php echo $token; ?>"/>
            <input type="text" name="email" placeholder="E-mail">
            <input type="password" name="password" placeholder="Password">
            <label><?= $message ?></label><br>
            <button type="submit" name="action" value="login" id="login-button">Login</button>
        </form>
        <form class="form" action="">
            <label><?= $message ?></label><br>
            <input class="button" id="register-close" type="submit" onclick="$('#register').toggle(); disableInput();"
                   value="Register"/>
        </form>
        <div id="register" style="display: none">
            <form class="form" method="POST" id="insert-user-form">
                <input type="email" name="email" placeholder="E-mail" required="true">
                <input type="text" name="first-name" placeholder="First Name" required="true">
                <input type="text" name="last-name" placeholder="Last Name" required="true">
                <input type="text" name="country" placeholder="Country" required="false">
                <input type="password" id="txtPass" name="password" placeholder="Password" required="true">
                <input type="password" id="txtConfirmPass"  placeholder="Confirm password" required="true">
                <div id="confirm"></div>
                <button type="submit" name="action" value="register" id="register-button">Register</button>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="/CandleLight/templates/js/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $('#insert-user-form').submit(function (e) {

            var insertbtn = $('#register-button');
            $.ajax({
                url: '/CandleLight/api/users/',
                type: 'post',
                dataType: 'text',
                cache: false,
                async: true,
                data: $('#insert-user-form').serialize()
            }).done(function (data) {
                $("#insert-user-form").trigger('reset');
                $('#register').toggle();
                document.getElementById("register-close").value = "Register";

            })
            e.preventDefault();
        });
        $(function() {
            $("#txtConfirmPass").keyup(function() {
                var password = $("#txtPass").val();
                $("#confirm").html(password == $(this).val() ? "Passwords match." : "Passwords do not match!");
            });

        });

    });
        function disableInput() {
            if (document.getElementById("register-close").type === "submit") {
                document.getElementById("register-close").type = "button";
                document.getElementById("register-close").value = "Close";
            } else if (document.getElementById("update").type === "button") {
                document.getElementById("update").type = "submit";
            }
        }
    ;
</script>
</body>
</html>

