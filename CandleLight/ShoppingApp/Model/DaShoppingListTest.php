<?php
/**
 * Created by PhpStorm.
 * User: Oualid
 * Date: 25/04/2015
 * Time: 20:00
 */

 namespace ShoppingApp\Model;

 use ShoppingApp\Bo\ShoppingList as ShoppingList;

 include_once '../../vendor/autoload.php';

 update();
 function insert()
 {
     $func = new \ShoppingApp\Model\DaShoppingList();
     $shoppinglist = new ShoppingList();
     $shoppinglist->setShoppingListName('inserttest');
     $shoppinglist->setUserId(9);
     $shoppinglist->setShoppingListDueDate(20150415);
     $shoppinglist->setAccess(1);
     $func->insert($shoppinglist);
 }
 

 function delete()
 {
     $shoppinglist = new ShoppingList();
     $shoppinglist->setShoppingListId(1);
     DaShoppingList::delete($shoppinglist);
 }
 

 function update()
 {
     $shoppinglist = new ShoppingList();
     $shoppinglist->setShoppingListId(12);
     $shoppinglist->setShoppingListName('broccoli');
     $shoppinglist->setOwnerText('test');
     $shoppinglist->setUserId(5);
     $shoppinglist->setShoppingListDueDate(20150428);
     $shoppinglist->setAccess(2);
     DaShoppingList::update($shoppinglist);
 }

 function updateByFriend()
 {
     $shoppinglist = new ShoppingList();
     $shoppinglist->setShoppingListId(2);
     $shoppinglist->setFriendsText('extra informatie');
     $shoppinglist->setLastUpdatedBy(3);
     DaShoppingList::updateByFriend($shoppinglist);
 }

 function selectOne()
 {
     $shoppinglist = new ShoppingList();
     $shoppinglist->setShoppingListId(2);
     DaShoppingList::selectOne($shoppinglist);
     echo "Dit is de naam van de lijst: " . $shoppinglist->getShoppingListName();
 }
 
 function selectAll()
 {
     $array = DaShoppingList::selectAll();
     foreach($array as $records){
         echo "Dit is de naam van de lijst: {$records['shopping_list_name']}, met de ID: {$records['shopping_list_id']}<br/>";
     }
 }
 

 function selectByUser()
 {
     $array = DaShoppingList::selectByUser(2);
     foreach($array as $records){
         echo "Dit is de naam van de lijst: {$records['shopping_list_name']}, met de ID: {$records['shopping_list_id']}<br/>";
     }
 }