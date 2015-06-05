<?php
include_once "vendor/autoload.php";
use Slim\Slim;

$app = new Slim();

$app->get('/', function () use ($app) {
    $app->render('index.php');
})->name('index');
$app->post('/login', function () use ($app) {
    $token = $app->request->post('token');
    $email = $app->request->post('email');
    $password = $app->request->post('password');
    $controller = new \ShoppingApp\Controllers\Authentication($token, $email, $password);
    $controller->login();
});
$app->get('/app/', function () use ($app) {
    $app->render('shoppingapp.php');
});
$app->get('/logout/', function () {
    \ShoppingApp\Controllers\Authentication::logout();
});

$auth = function (\Slim\Route $route) {
    if (array_key_exists('key', $route->getParams())) {
        $token = new \ShoppingApp\Controllers\Authentication($route->getParam('key'), '', '');
        if ($token->validateKey() == false) {
            $app = \Slim\Slim::getInstance();
            $app->redirect($app->urlFor('index'));
        }
    } else {
        if (!isset($_SESSION['token'])) {
            $token = new \ShoppingApp\Controllers\Authentication($_SESSION['token'], '', '');
            if ($token->validate() === false) {
                $app = \Slim\Slim::getInstance();
                $app->redirect($app->urlFor('index'));
            }
        } else {
            $app = \Slim\Slim::getInstance();
            $app->redirect($app->urlFor('index'));
        }
    }
};

// private API
$app->put('/api/users/:id/', 'auth', 'updateUser');
$app->post('/api/users', 'insertUser');
$app->put('/api/users/friends/requests/:id/:friendid/', 'auth', 'acceptRequest');
$app->delete('/api/users/friends/requests/:id/:friendid/', 'auth', 'deleteFriend');
$app->post('/api/users/friends/requests/:id/:friendid/', 'auth', 'addFriend');
$app->get('/api/users/lists/:id(/:key)', $auth, 'getListsByUser');
$app->get('/api/users/list/:id(/:key)', $auth, 'getList');
$app->delete('/api/users/lists/:id', 'auth', 'deleteList');
$app->post('/api/users/password/:id/','auth', 'updatePassword');
$app->put('/api/users/list/:id', 'auth', 'updateList');
$app->post('/api/users/list', 'auth', 'insertList');

// public API
$app->get('/api/users(/:key)', $auth, 'getUsers')->conditions(array('key' => '[A-z]'));
$app->get('/api/users/:id(/:key)', $auth, 'getUser')->conditions(array('id' => '\d'));
$app->get('/api/users/friends/:id(/:key)', $auth, 'getFriends')->conditions(array('id' => '\d'));
$app->get('/api/users/friends/requests/:id(/:key)', $auth, 'getFriendsRequests');
$app->get('/api/users/friends/search/:keyword(/:key)', $auth, 'searchFriends');

$app->run();

// authentication
function auth()
{
    if (!isset($_SESSION['token'])) {
        $token = new \ShoppingApp\Controllers\Authentication($_SESSION['token'], '', '');
        if ($token->validate() === false) {
            $app = \Slim\Slim::getInstance();
            $app->redirect($app->urlFor('index'));
        }
    } else {
        $app = \Slim\Slim::getInstance();
        $app->redirect($app->urlFor('index'));
    }
}

// USERS functions
function getUsers()
{
    $controller = new \ShoppingApp\Controllers\User();
    echo($controller->getUsers());
}

function getUser($id)
{
    $controller = new \ShoppingApp\Controllers\User();
    echo($controller->getUser($id));
}

function updateUser($id)
{
    $User = new ShoppingApp\Bo\User();
    $request = Slim::getInstance()->request();
    $User->setUserId($id);
    $User->setFirstName($request->put('first-name'));
    $User->setLastName($request->put('last-name'));
    $User->setCountry($request->put('country'));
    $User->setEmail($request->put('email'));
    $controller = new \ShoppingApp\Controllers\User();
    echo $controller->updateUser($User);
}

function insertUser()
{
    $User = new ShoppingApp\Bo\User();
    $request = Slim::getInstance()->request();
    $User->setFirstName($request->post('first-name'));
    $User->setLastName($request->post('last-name'));
    $User->setCountry($request->post('country'));
    $User->setEmail($request->post('email'));
    $User->setPassword($request->post('password'));
    $controller = new \ShoppingApp\Controllers\User();
    echo $controller->insertUser($User);
}

function updatePassword($id)
{
    $controller = new \ShoppingApp\Controllers\User();
    $request = Slim::getInstance()->request();
    $email = $request->post('emailz');
    $oldPassword = $request->post('old-password');
    $newPassword = $request->post('new-password');
    $newPasswordVerify = $request->post('new-password-verify');
    echo $controller->updatePassword($id, $email, $oldPassword, $newPasswordVerify, $newPassword);
}

// FRIENDS
function getFriends($id)
{
    $controller = new \ShoppingApp\Controllers\User();
    echo $controller->getFriends($id);
}

function getFriendsRequests($id)
{
    $controller = new \ShoppingApp\Controllers\User();
    echo $controller->getFriendsRequest($id);
}

function searchFriends($keyword)
{
    $controller = new \ShoppingApp\Controllers\User();
    echo $controller->searchUsers($keyword);
}

function acceptRequest($id, $friendId)
{
    $controller = new \ShoppingApp\Controllers\User();
    echo $controller->acceptRequest($id, $friendId);
}

function deleteFriend($id, $friendId)
{
    $controller = new \ShoppingApp\Controllers\User();
    echo $controller->deleteFriend($id, $friendId);
}

function addFriend($id, $friendId)
{
    $controller = new \ShoppingApp\Controllers\User();
    echo $controller->addFriend($id, $friendId);
}

// LISTS
function insertList()
{
    $Shoppinglist = new ShoppingApp\Bo\ShoppingList();
    $request = Slim::getInstance()->request();
    $Shoppinglist->setShoppingListName($request->post('list-name'));
    $Shoppinglist->setUserId($request->post('user-id'));
    $Shoppinglist->setShoppingListDueDate($request->post('due-date'));
    $Shoppinglist->setAccess($request->post('access'));
    $controller = new \ShoppingApp\Controllers\ShoppingList();
    echo $controller->insertList($Shoppinglist);
}

function getList($id)
{
    $controller = new \ShoppingApp\Controllers\ShoppingList();
    echo ($controller->getList($id));
}

function getListsByUser($id)
{
    $controller = new \ShoppingApp\Controllers\ShoppingList();
    echo $controller->getListsByUser($id);
}

function deleteList($id)
{
    $controller = new \ShoppingApp\Controllers\ShoppingList();
    echo $controller->deleteList($id);
}

function updateList($id)
{
    $Shoppinglist = new ShoppingApp\Bo\ShoppingList();
    $request = Slim::getInstance()->request();
    $Shoppinglist->setShoppingListId($id);
    $Shoppinglist->setShoppingListName($request->put('list-name'));
    $Shoppinglist->setUserId($request->put('user-id'));
    //$Shoppinglist->setOwnerText($request->put('owner-text'));
    //$Shoppinglist->setFriendsText($request->put('friends-text'));
    $Shoppinglist->setAccess($request->put('access'));
    $Shoppinglist->setShoppingListDueDate($request->put('due-date'));
    $controller = new \ShoppingApp\Controllers\ShoppingList();
    echo $controller->updateList($Shoppinglist);
}