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
 $shoppinglist->setShoppingListName('carneval');
 $shoppinglist->setUserId(2);
 $shoppinglist->setAmount(50);
 $shoppinglist->setAmountUnit('kg');
 $shoppinglist->setShoppingListCreated('2015-04-10');
 $shoppinglist->setShoppingListDueDate(20150415);
 $shoppinglist->setAccess(1);
 DaShoppingList::insert($shoppinglist);