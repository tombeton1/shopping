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

 $shoppinglist = new ShoppingList();
 //$shoppinglist->setShoppingListName('carneval');
 //$shoppinglist->setUserId(2);
 //$shoppinglist->setAmount(50.45);
 //$shoppinglist->setAmountUnit('kg');
 //$shoppinglist->setShoppingListCreated('2015-04-10');
 //$shoppinglist->setShoppingListDueDate(20150415);
 //$shoppinglist->setAccess(1);
 //DaShoppingList::insert($shoppinglist);

 //$shoppinglist->setShoppingListId(1);
 //DaShoppingList::delete($shoppinglist);

 $shoppinglist->setShoppingListId(2);
 $shoppinglist->setShoppingListName('bloemkool');
 $shoppinglist->setUserId(2);
 $shoppinglist->setShoppingListDueDate(20150428);
 $shoppinglist->setAccess(2);
 DaShoppingList::update($shoppinglist);

 //amount & amountunit moet weg, in product/shoppinglist tussentabel