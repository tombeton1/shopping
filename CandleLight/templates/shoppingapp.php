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
    <link href="/CandleLight/templates/css/bootstrap.min.css" rel="stylesheet">
    <link href="/CandleLight/templates/css/app.css" rel="stylesheet">

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
<nav class="header">
<a id="responsive-menu-button" href="#sidr"><section class="material-design-hamburger">
    <button class="material-design-hamburger__icon">
        <span class="material-design-hamburger__layer"></span>
    </button>
    </section></a>
</nav>
<div class="tabs">
    <div id="sidr">
        <ul class="tab-links">
            <li><div class="circle"></div></li>
            <li class="user-name">Hi! <?= $User->getFirstName()?></li>
            <li class="active"><a href="#tab1">Grocery List</a></li>
            <li><a href="#tab2">Friends <div class="sidebar-grey-badge" id="friends"></div></a>
                <ul>
                    <li><a href="#tab3"> Search for Friends</a></li>
                    <li><a href="#tab4">Friend requests <div class="sidebar-badge" id="requests"></div></a></li>
                </ul>
            </li>
            <li><a href="#tab5">Settings</a></li>
            <li><a href="/CandleLight/logout">Log out</a></li>
        </ul>
    </div>
    <div class="tab-content">
        <div id="tab1" class="tab active">
            <div class="col-lg-4">
                <h1>Your Grocery list</h1>
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
            <input class="form-control" id="search-users" type="text" name="keyword" placeholder="Name or Email (minimal 3 characters)">
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
            <div id="fade"></div>
                <div class="col-lg-4">
                    <h1>Settings</h1>
                    <form class="form form-horizontal" id="update-user-form">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" for="first-name">First name</label>
                                        <div class="col-sm-8">
                                            <input id="first-name" class="form-control" type="text" name="first-name"
                                                   maxlength="50"
                                                   pattern="[^()[\]{}*&^%$<>#0-9@!]+$" required="true" disabled/>
                                            </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" for="last-name">Family name</label>
                                        <div class="col-sm-8">
                                            <input id="last-name" class="form-control" type="text" name="last-name"
                                                   maxlength="50"
                                                   pattern="[^()[\]{}*&^%$<>#0-9@!]+$" required="true" disabled/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" for="country">Country</label>
                                        <div class="col-sm-8">
                                            <input id="country" class="form-control" type="text" name="country"
                                                   maxlength="50"
                                                   pattern="[^()[\]{}*&^%$<>#0-9@!]+$" required="false" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" for="user-email">Email</label>
                                        <div class="col-sm-8">
                                            <input id="email" class="form-control" type="email" maxlength="100"
                                                   pattern="\b[A-Z0-9._+-]+@(?:[A-Z0-9-]+\.)+[A-Z]{2,4}\b$)"
                                                   name="email" required="true" disabled/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label"></label>
                                        <div class="col-sm-8">
                                            <input  class="button-flat button-yellow" id="update" type="submit" value="Edit Info" />
                                            <input class="button-flat button-yellow" id="password" type="submit" value="Change Password" />
                                        </div>
                                    </div>
                                </form>
                    <div id="modal">
                            <div class="content">test</div>
                    </div>
                </div>
        </div>
                </div>
        </div>
        <script type="text/javascript" src="/CandleLight/templates/js/jquery.min.js"></script>
        <script type="text/javascript" src="/CandleLight/templates/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="/CandleLight/templates/js/jquery.sidr.min.js"></script>
        <script type="text/javascript" src="/CandleLight/templates/js/jquery.touchwipe.min.js"></script>
        <script type="text/javascript" src="/CandleLight/templates/js/ShoppingApp.js"></script>
        <script type="text/javascript">
            ShoppingApp.init({
                url: "/CandleLight/api/users/",
                userId: "<?=$User->getUserId()?>"
            });
        </script>
</body>
</html> 