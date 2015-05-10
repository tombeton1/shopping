<?php
session_start();
$User;
if(!isset($_SESSION['user'])) {
    header("Location: /CandleLight/");
} else {
   $User = $_SESSION['user'];
}
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>App</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/CandleLight/templates/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/CandleLight/templates/css/jquery.sidr.light.css">
    <style>
        .tab-links:after {
            display: block;
            clear: both;
            content: '';
        }
        .tab {
            display: none;
        }
        .tab.active {
            display: block;
        }
        .sidr-inner{
            background-color: #53e3a6;
        }
    </style>
</head>
<body>
<a id="simple-menu" href="#sidr">Toggle menu</a>
<div class="tabs">
    <div id="sidr">
        <ul class="tab-links">
            <li class="active"><a href="#tab1">Grocery List</a></li>
            <li><a href="#tab2">Friends</a></li>
            <li><a href="#tab3">Settings</a></li>
            <li><a href="/CandleLight/logout">Log out</a></li>
        </ul>
    </div>
    <div class="tab-content">
        <div id="tab1" class="tab active">
            <?= $User->getFirstName();?>
        </div>
        <div id="tab2" class="tab">
            shopping list
        </div>
        <div id="tab3" class="tab">
            recipes
        </div>
    </div>
</div>
<script type="text/javascript" src="/CandleLight/templates/js/jquery.min.js"></script>
<script type="text/javascript" src="/CandleLight/templates/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/CandleLight/templates/js/jquery.sidr.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#simple-menu').sidr();
        $('.tabs .tab-links a').on('click', function (e) {
            var currentAttrValue = $(this).attr('href');
            $('.tabs ' + currentAttrValue).show().siblings().hide();
            $(this).parent('li').addClass('active').siblings().removeClass('active');
            e.preventDefault();
        });
        loadUsers();
        loadUser(3);
    });
    function loadUsers() {
        $.ajax({
            url: '/CandleLight/api/users',
            type: 'GET',
            dataType: 'json',
            cache: false,
            async: true
        }).done(function (data) {
            console.log(data);
        });
    };
    function loadUser(id) {
        $.ajax({
            url: '/CandleLight/api/users/' + id,
            type: 'GET',
            dataType: 'json',
            cache: false,
            async: true
        }).done(function (data) {
            console.log(data);
        });
    };
</script>
</body>
</html> 