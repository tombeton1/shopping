<?php
/**
 * Created by PhpStorm.
 * User: lenny
 * Date: 24/04/15
 * Time: 21:44
 */
namespace ShoppingApp\Model;
include_once '../../vendor/autoload.php';
//$func = new \ShoppingApp\Model\DaUser();
//
//$User = new \ShoppingApp\Bo\User();
//$User->setFirstName('test');
//$User->setLastName('test');
//$User->setEmail('test@test.com');
//$User->setCountry('belgie');
//$User->setPassword('test');
//echo $func->insert($User);

//$User = new \ShoppingApp\Bo\User();
//$User->setUserId(1);
//$User->setFirstName('ble');
//$User->setLastName('ddd');
//$User->setEmail('dsdfds@sfd');
//$User->setCountry('dsdds');
//echo \ShoppingApp\Model\DaUser::update($User);

//$User = \ShoppingApp\Model\DaUser::selectOne(2);
//echo $User->getUserId();
//echo $User->getFirstName();
//echo $User->getLastName();
//echo $User->getCountry();
//echo $User->getEmail();
//echo $User->getFirstName();

//$Users = \ShoppingApp\Model\DaUser::selectAll();
//foreach($Users as $User){
//     echo $User->getUserId();
//     echo $User->getFirstName();
//     echo $User->getLastName();
//     echo $User->getEmail();
//     echo $User->getCountry();
//}

//$email = 'test@test.com';
//$password = 'test';
//$User = new \ShoppingApp\Model\DaUser();
//if($User->checkPassword($email, $password)){
//   $firstname = $User->checkPassword($email, $password);
//    print_r($firstname->getUserId());
//
//} else {
//    echo'fout';
//}


//$id = 1;
//\ShoppingApp\Model\DaUser::delete($id);

//$UserId = 4;
//$FriendId = 2;
//$func = new \ShoppingApp\Model\DaUser();
//echo $func->addFriend($UserId, $FriendId);

$func = new \ShoppingApp\Model\DaUser();
echo $func->acceptFriend(3,2);

//$UserId = '4';
//$func = new \ShoppingApp\Model\DaUser();
//$Friends = $func->selectAllFriends($UserId);
//foreach($Friends as $User){
//     echo $User->getUserId();
//     echo $User->getFirstName();
//     echo $User->getLastName();
//     echo $User->getEmail();
//}

//$keyword = 'adrie';
//$Users = \ShoppingApp\Model\DaUser::searchUsers($keyword);
//foreach($Users as $User){
//        echo $User->getUserId();
//        echo $User->getFirstName();
//        echo $User->getLastName();
//        echo $User->getEmail();
//}