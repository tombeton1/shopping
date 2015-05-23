<?php
session_start();
$User = NULL;
if (!isset($_SESSION['user'])) {
    header("Location: /CandleLight/");
} else {
    $User = $_SESSION['user'];
}
$rootUrl = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';

?>
<!DOCTYPE HTML>
<html>
<head>
    <title>App</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
    <link href="/CandleLight/templates/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<a id="responsive-menu-button" href="#sidr">Toggle menu</a>
<div class="tabs">
    <div id="sidr">
        <ul class="tab-links">
            <button id="menu-close-btn" type="button" onclick="$.sidr('close', 'sidr');">Close</button>
            <li class="active"><a href="#tab1">Grocery List</a></li>
            <li><a href="#tab2">Friends</a>
                <ul>
                    <li><a href="#tab3"> Search for Friends</a></li>
                    <li><a id="requests" href="#tab4"></li>
                </ul>
            </li>
            <li><a href="#tab5">Settings</a></li>
            <li><a href="/CandleLight/logout">Log out</a></li>
        </ul>
    </div>
    <div class="tab-content">
        <div id="tab1" class="tab active">
            <div class="col-lg-4">
            <p>Welkom <?= $User->getFirstName()?> <?= $User->getLastName();?></p>
            </div>
        </div>
        <div id="tab2" class="tab">
            <div class="col-lg-4">
            <h1>Friends</h1>
            <div id="friends-list"></div>
            </div>
        </div>
        <div id="tab3" class="tab">
            <div class="col-lg-4">
            <h1>Search for friends</h1>
            <div id="add-friend-message"></div>
            <input class="form-control" id="search-users" type="text" name="keyword" placeholder="Search by username, name or email (minimal 3 characters)">
            <div class="col-lg-12" id="results"></div>
            </div>
        </div>
        <div id="tab4" class="tab">
            <div class="col-lg-4">
            <h1>Friends requests</h1>
                <div id="request-friend-message"></div>
            <div id="friends-requests-list"></div>
            </div>
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
                                            <input class="button" id="update" type="submit" value="Edit"/>
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
        <script type="text/javascript" src="/CandleLight/templates/js/ShoppingApp.js"></script>
        <script type="text/javascript" src="/CandleLight/templates/js/jquery.touchwipe.min.js"></script>
        <script type="text/javascript">
            ShoppingApp.init({
                url: "/CandleLight/api/users/",
                userId: "<?=$User->getUserId()?>"
            });
        </script>
</body>
</html> 