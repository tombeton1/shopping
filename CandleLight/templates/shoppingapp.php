<?php
session_start();

$User = NULL;
if (!isset($_SESSION['user'])) {
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

        .sidr-inner {
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
            <li><a href="#tab2" onclick="getFriends();">Friends</a>
                <ul>
                    <li><a href="#tab3"> Search for Friends</a></li>
                    <li><a href="#tab4">Friend requests</a></li>
                </ul>
            </li>
            <li><a href="#tab5">Settings</a></li>
            <li><a href="/CandleLight/logout">Log out</a></li>
        </ul>
    </div>
    <div class="tab-content">
        <div id="tab1" class="tab active">
            <p>Welkom <?= $User->getFirstName()?> <?= $User->getLastName();?></p>
        </div>
        <div id="tab2" class="tab">
            <h1>Friends</h1>
            <div id="friends-list"></div>
        </div>
        <div id="tab5" class="tab">
                <div class="col-lg-7 ">
                    <div id="create-user">
                        <div class="col-lg-* col-md-* col-sm-* col-xs-* ">
                            <div class="grey-border">
                                <form class="form form-horizontal" id="update-user-form">
                                    <div class="form-group  text-center">
                                        <label class="col-sm-2 control-label"></label>

                                        <div class="col-sm-4">
                                            <h2 class="h2">User</h2>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="first-name">First name</label>

                                        <div class="col-sm-4">
                                            <input id="first-name" class="form-control" type="text" name="first-name"
                                                   maxlength="50"
                                                   pattern="[^()[\]{}*&^%$<>#0-9@!]+$" required="true" disabled/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="last-name">Family name</label>

                                        <div class="col-sm-4">
                                            <input id="last-name" class="form-control" type="text" name="last-name"
                                                   maxlength="50"
                                                   pattern="[^()[\]{}*&^%$<>#0-9@!]+$" required="true" disabled/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="country">Country</label>

                                        <div class="col-sm-4">
                                            <input id="country" class="form-control" type="text" name="country"
                                                   maxlength="50"
                                                   pattern="[^()[\]{}*&^%$<>#0-9@!]+$" required="false" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="user-email">Email</label>

                                        <div class="col-sm-4">
                                            <input id="email" class="form-control" type="email" maxlength="100"
                                                   pattern="\b[A-Z0-9._+-]+@(?:[A-Z0-9-]+\.)+[A-Z]{2,4}\b$)"
                                                   name="email" required="true" disabled/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label"></label>

                                        <div class="col-sm-2">
                                            <input class="button" id="update" type="submit" value="Edit"
                                                   onClick="enableInput()"/>
                                        </div>
                                    </div>
                                </form>
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
                loadUser();
                loadUsers();

                $('#update-user-form').submit(function (e) {

                    var updatebtn = $('#update');
                    $.ajax({
                        url: '/CandleLight/api/users/<?=$User->getUserId()?>',
                        type: 'put',
                        dataType: 'text',
                        cache: false,
                        async: true,
                        data: $('#update-user-form').serialize(),
                        beforeSend: function () {
                            updatebtn.val('updating').attr('disabled', 'disabled');
                        }
                    }).done(function (data) {

                    }).always(function () {
                        loadUser();
                        disableInput();
                        updatebtn.val('edit').removeAttr('disabled');
                    });
                    e.preventDefault();
                });
            });
            function loadUsers() {
                $.ajax({
                    url: '/CandleLight/api/users',
                    type: 'GET',
                    dataType: 'json',
                    cache: false,
                    async: true
                }).done(function (data) {

                });
            }
            ;
            function loadUser() {
                $.ajax({
                    url: '/CandleLight/api/users/<?= $User->getUserId();?>',
                    type: 'GET',
                    dataType: 'json',
                    cache: false,
                    async: true
                }).done(function (data) {
                    $("#first-name").val(data.firstName);
                    $("#last-name").val(data.lastName);
                    $("#country").val(data.country);
                    $("#email").val(data.email);
                });
            }
            ;
            function getFriends(){
                $.ajax({
                    url:'/CandleLight/api/users/friends/3',
                    type: 'GET',
                    dataType: 'json',
                    cache: false,
                    async: true
                }).done(function (data){
                    $('#friends-list').html('');
                    data.forEach(function (user) {
                        $('#friends-list').append('<p>' + user.firstName + ' ' + user.lastName +  '</p>');
                        console.log(user.firstName);
                        console.log(user.lastName);

                    });
                })
            }
            function enableInput() {
                if (document.getElementById("update").type === "submit") {
                    document.getElementById("update").type = "button";
                    document.getElementById("update").value = "Update";
                    document.getElementById("first-name").disabled = false;
                    document.getElementById("last-name").disabled = false;
                    document.getElementById("country").disabled = false;
                    document.getElementById("email").disabled = false;
                } else if (document.getElementById("update").type === "button") {
                    document.getElementById("update").type = "submit";
                }
            }
            ;

            function disableInput() {
                document.getElementById("first-name").disabled = true;
                document.getElementById("last-name").disabled = true;
                document.getElementById("country").disabled = true;
                document.getElementById("email").disabled = true;
            }
            ;
        </script>
</body>
</html> 