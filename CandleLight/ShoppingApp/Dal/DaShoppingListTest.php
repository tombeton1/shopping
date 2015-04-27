<?php
/**
 * Created by PhpStorm.
 * User: Oualid
 * Date: 25/04/2015
 * Time: 20:00
 */

 namespace ShoppingApp\Dal;

 use ShoppingApp\Bo\ShoppingList as ShoppingList;

 include_once '../../vendor/autoload.php';

 # insert
 $shoppinglist = new ShoppingList();
 //$shoppinglist->setShoppingListName('carneval');
 //$shoppinglist->setUserId(2);
 //$shoppinglist->setAmount(50.45);
 //$shoppinglist->setAmountUnit('kg');
 //$shoppinglist->setShoppingListCreated('2015-04-10');
 //$shoppinglist->setShoppingListDueDate(20150415);
 //$shoppinglist->setAccess(1);
 //DaShoppingList::insert($shoppinglist);

 # delete
 //$shoppinglist->setShoppingListId(1);
 //DaShoppingList::delete($shoppinglist);

 # update
 //$shoppinglist->setShoppingListId(2);
 //$shoppinglist->setShoppingListName('bloemkool');
 //$shoppinglist->setUserId(2);
 //$shoppinglist->setShoppingListDueDate(20150428);
 //$shoppinglist->setAccess(2);
 //DaShoppingList::update($shoppinglist);

 # select one
 //$shoppinglist->setShoppingListId(2);
 //DaShoppingList::selectOne($shoppinglist);
 //echo "Dit is de naam van de lijst: " . $shoppinglist->getShoppingListName();

 # select all
 $array = DaShoppingList::selectAll();
 foreach($array as $record){
     echo "Key: $record[0]; Value: $record[1]<br>";
 }

 //amount & amountunit moet weg, in product/shoppinglist tussentabel