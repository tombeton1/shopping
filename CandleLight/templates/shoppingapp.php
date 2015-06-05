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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        .tab-links:after {
            display: block;
            clear: both;
            content: '';
        }
        .tab {
            display: none;
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
<div id="fade" class="overlay"></div>
<div class="tabs">
    <div id="sidr">
        <ul class="tab-links">
            <li><div class="circle"></div></li>
            <li class="user-name">Hi! <?= $User->getFirstName()?></li>
            <li class="date" id="date"></li>
            <li><a href="#tab1">Grocery List <div class="sidebar-grocery-badge" id="groceries"></div></a></li>
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
                <button id="add-grocery-list" class="button-flat button-green material-icons md-48">add_circle</button>
                <div id="groceries-list"></div>
                <div id="add-grocery-modal" class="modal">
                    <div class="content">
                        <form id="create-list">
                            <div class="form-group">
                                <div class="col-md-10">
                                    <label>Name</label>
                                    <input id="list-name-create" class="form-control" type="text" name="list-name"/><br>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-10">
                                    <label>List</label>
                                    <p id="owner-text-create">- Komkommer<br> - Tomaat<br></p>
                                    <p id="friends-text-create">- Banaan</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-10">
                                    <label>New Product</label>
                                    <input class="form-control" type="text"/><br>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-10">
                                    <label>Due Date</label>
                                    <input id="due-date-create" class="form-control" type="text" name="due-date"/><br>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-10">
                                    <label>Access</label><br>
                                    <input type="radio" name="access" value="0" id="radio-private-create">
                                    <label for="r1">Private</label>
                                    <input type="radio" name="access" value="1" id="radio-public-create">
                                    <label for="r2">Public</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <input  class="button-flat button-yellow" id="create-grocery-list" type="submit" value="Create List" />
                                <input  class="button-flat button-yellow" id="create-grocery-list" type="button" value="Cancel" />
                            </div>
                        </form>
                    </div>
                </div>
                <div id="view-modal" class="modal">
                    <div class="content">
                        <form id="view-list">
                            <div class="form-group">
                                <div class="col-md-10">
                                    <label>Name</label>
                                    <input id="list-name-view" class="form-control" type="text" disabled/><br>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-10">
                                    <label>List</label>
                                    <p id="owner-text-view">- Komkommer<br> - Tomaat<br></p>
                                    <p id="friends-text-view">- Banaan</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-10">
                                    <label>Due Date</label>
                                    <input id="due-date-view" class="form-control" type="text" disabled/><br>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-10">
                                    <label>Access</label><br>
                                    <input type="radio" name="access-view" value="0" id="radio-private-view" disabled>
                                    <label for="r1">Private</label>
                                    <input type="radio" name="access-view" value="1" id="radio-public-view" disabled>
                                    <label for="r2">Public</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <input  class="button-flat button-yellow" id="view-grocery-list" type="submit" value="Change List" />
                                <input  class="button-flat button-yellow" id="view-grocery-list" type="button" value="Cancel" />
                            </div>
                        </form>
                    </div>
                </div>
                <div id="list-modal" class="modal">
                    <div class="content">
                        <form id="update-list">
                            <div class="form-group">
                                <div class="col-md-10">
                                    <label>Name</label>
                                    <input id="list-name" class="form-control" type="text" name="list-name"/><br>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-10">
                                    <label>List</label>
                                    <p id="owner-text">- Komkommer<br> - Tomaat<br></p>
                                    <p id="friends-text">- Banaan</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-10">
                                    <label>New Product</label>
                                    <input class="form-control" type="text"/><br>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-10">
                                    <label>Due Date</label>
                                    <input id="due-date" class="form-control" type="text" name="due-date"/><br>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-10">
                                    <label>Access</label><br>
                                    <input type="radio" name="access" value="0" id="radio-private">
                                    <label for="r1">Private</label>
                                    <input type="radio" name="access" value="1" id="radio-public">
                                    <label for="r2">Public</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <input  class="button-flat button-yellow" id="update-grocery-list" type="submit" value="Change List" />
                                <input  class="button-flat button-yellow" id="update-grocery-list" type="button" value="Cancel" />
                            </div>
                        </form>
                    </div>
                </div>
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
                                            <input class="button-flat button-yellow" id="password" type="button" value="Change Password" />
                                        </div>
                                    </div>
                                </form>
                    <div id="modal" class="modal">
                            <div class="content">
                                <form id="update-password-form">
                                    <input type="hidden" name="emailz" value="<?=$User->getEmail();?>" />
                                    <div class="form-group">
                                        <div class="col-md-10">
                                            <label>Existing password</label>
                                            <input class="form-control" type="text" name="old-password"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-10">
                                        <label>New password</label>
                                        <input class="form-control" name="new-password" type="text"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-10">
                                        <label>New password</label>
                                        <input class="form-control" name="new-password-verify" type="text"/><br>
                                        </div>
                                    </div>
                                        <div class="col-md-10">
                                            <div class="red-error-message" id="update-password-message"></div>
                                        </div>
                                    <div class="form-group">
                                        <input  class="button-flat button-yellow" id="update-password-btn" type="submit" value="Change Password" />
                                        <input  class="button-flat button-yellow" type="button" value="Cancel" />
                                    </div>
                                </form>
                            </div>
                    </div>
                </div>
            </div>
         </div>
        </div>

        <script type="text/javascript" src="/CandleLight/templates/js/jquery.min.js"></script>
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