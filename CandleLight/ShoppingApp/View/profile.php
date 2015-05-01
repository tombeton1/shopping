<?php
if(isset($_SESSION["user"])) {
    header("location:profile.php");
} else {
    header("location:/index.php");
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
  <title></title>
</head>
<body>
    loggedin
</body>
</html> 