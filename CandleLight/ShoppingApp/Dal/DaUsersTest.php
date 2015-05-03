<?php
/**
 * Created by PhpStorm.
 * User: lenny
 * Date: 24/04/15
 * Time: 21:44
 */
namespace ShoppingApp\Dal;
include_once '../../vendor/autoload.php';

$User = new \ShoppingApp\Bo\User();
$User->setFirstName('test');
$User->setLastName('test');
$User->setEmail('tom@tom.com');
$User->setCountry('belgie');
$User->setPassword('tom');
echo \ShoppingApp\Dal\DaUser::insert($User);

//$User = new \ShoppingApp\Bo\User();
//$User->setUserId(1);
//$User->setFirstName('ble');
//$User->setLastName('ddd');
//$User->setEmail('dsdfds@sfd');
//$User->setCountry('dsdds');
//echo \ShoppingApp\Dal\DaUser::update($User);

//$User = \ShoppingApp\Dal\DaUser::selectOne(2);
//echo $User->getUserId();
//echo $User->getFirstName();
//echo $User->getLastName();
//echo $User->getCountry();
//echo $User->getEmail();
//echo $User->getFirstName();

//$Users = \ShoppingApp\Dal\DaUser::selectAll();
//foreach($Users as $User){
//     echo $User->getUserId();
//     echo $User->getFirstName();
//     echo $User->getLastName();
//     echo $User->getEmail();
//     echo $User->getCountry();
//}

//$email = 'test@test.com';
//$password = 'test';
//if (\ShoppingApp\Dal\DaUser::login($email, $password)){
//    echo'correct';
//} else {
//    echo'bad password';
//};

//$id = 1;
//\ShoppingApp\Dal\DaUser::delete($id);

//$UserId = 3;
//$FriendId = 2;
//echo \ShoppingApp\Dal\DaUser::addFriend($UserId, $FriendId);

//echo \ShoppingApp\Dal\DaUser::acceptFriend(3, 2);

//$UserId = '3';
//$Friends = \ShoppingApp\Dal\DaUser::selectAllFriends($UserId);
//foreach($Friends as $User){
//     echo $User->getUserId();
//     echo $User->getFirstName();
//     echo $User->getLastName();
//     echo $User->getEmail();
//}

//$keyword = 'adrie';
//$Users = \ShoppingApp\Dal\DaUser::searchUsers($keyword);
//foreach($Users as $User){
//        echo $User->getUserId();
//        echo $User->getFirstName();
//        echo $User->getLastName();
//        echo $User->getEmail();
//}