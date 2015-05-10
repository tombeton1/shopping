<?php
session_start();
$User = NULL;
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
            <?= $User->getFirstName(), $User->getLastName();?>
        </div>
        <div id="tab2" class="tab">
            shopping list
        </div>
        <div id="tab3" class="tab">
            <div class="tab-content">
                <div class="col-lg-7 ">
                    <div id="create-user">
                        <div class="col-lg-* col-md-* col-sm-* col-xs-* ">
                            <div class="grey-border">
                                <form class="form form-horizontal " id="create-user-form">
                                    <div class="form-group  text-center">
                                        <label class="col-sm-2 control-label"></label>

                                        <div class="col-sm-4">
                                            <h2 class="h2">User</h2>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="first-name">First name</label>

                                        <div class="col-sm-4">
                                            <input class="form-control" type="text" name="last-name" maxlength="50"
                                                   pattern="[^()[\]{}*&^%$<>#0-9@!]+$" required="true"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="last-name">Family name</label>

                                        <div class="col-sm-4">
                                            <input class="form-control" type="text" name="last-name" maxlength="50"
                                                   pattern="[^()[\]{}*&^%$<>#0-9@!]+$" required="true"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="country">Country</label>

                                        <div class="col-sm-4">
                                            <input class="form-control" type="text" name="country" maxlength="50"
                                                   pattern="[^()[\]{}*&^%$<>#0-9@!]+$" required="false">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="user-email">Email</label>

                                        <div class="col-sm-4">
                                            <input class="form-control" type="email" maxlength="100"
                                                   pattern="\b[A-Z0-9._+-]+@(?:[A-Z0-9-]+\.)+[A-Z]{2,4}\b$)"
                                                   name="email" required="true">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="password">Password</label>

                                        <div class="col-sm-4">
                                            <input class="form-control" id="inputPassword" type="password"
                                                   name="password"
                                                   data-minlength="6" maxlength="15" required="true">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="confirm-password">Confirm
                                            password</label>

                                        <div class="col-sm-4">
                                            <input class="form-control" type="password" data-minlength="6"
                                                   maxlength="15" data-match="#inputPassword"
                                                   data-match-error="Passwords don't match"
                                                   name="check" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label"></label>

                                        <div class="col-sm-2">
                                            <button type="submit" class="button-default">insert or update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
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
    function loadUser() {
        $.ajax({
            url: '/CandleLight/api/users/<?=$User->getUserId();?>',
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