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

 # insert
 $shoppinglist = new ShoppingList();
 $shoppinglist->setShoppingListName('carneval');
 $shoppinglist->setUserId(2);
 $shoppinglist->setShoppingListCreated('2015-04-10');
 $shoppinglist->setShoppingListDueDate(20150415);
 $shoppinglist->setAccess(1);
 //voorbeeld gegevens. de bedoeling is dat je de nodige gegevens automatiseert
 $products[] = ["id" => 6, "amount" => 5.1, "unit" => "kg"];
 $products[] = ["id" => 3, "amount" => 6.7, "unit" => "cm"];
 $shoppinglist->setListProducts($products);
 //DaShoppingList::insert($shoppinglist);

 # delete
 //$shoppinglist->setShoppingListId(1);
 //DaShoppingList::delete($shoppinglist);

 # update
 $shoppinglist->setShoppingListId(26);
 $shoppinglist->setShoppingListName('bloemkool');
 //$shoppinglist->setUserId(2);
 //$shoppinglist->setShoppingListDueDate(20150428);
 //$shoppinglist->setAccess(2);
 //DaShoppingList::update($shoppinglist);

 # select one
 //$shoppinglist->setShoppingListId(2);
 //DaShoppingList::selectOne($shoppinglist);
 //echo "Dit is de naam van de lijst: " . $shoppinglist->getShoppingListName();

 # select all
 //$array = DaShoppingList::selectAll();

 # select by user
 $array = DaShoppingList::selectByUser(2);

 //amount & amountunit moet weg, in product/shoppinglist tussentabel