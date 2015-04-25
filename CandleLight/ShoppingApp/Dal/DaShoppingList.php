<?php
/**
 * Created by PhpStorm.
 * User: Oualid
 * Date: 25/04/2015
 * Time: 18:57
 */

 namespace ShoppingApp\Dal;

 class DaShoppingList
 {
     public static function insert($shoppinglist)
     {
         try {
             $conn = \ShoppingApp\Dal\DataSource::getConnection();
             $stmt = $conn->prepare('CALL shopping_list_insert(@pId, :pName, :pUserId, :pAmount, :pAmountUnit, :pCreated, :pDueDate, :pAccess)');
             $stmt->bindValue(':pName', $shoppinglist->getShoppingListName(), \PDO::PARAM_STR);
             $stmt->bindValue(':pUserId', $shoppinglist->getUserId(), \PDO::PARAM_INT);
             $stmt->bindValue(':pAmount', $shoppinglist->getAmount(), \PDO::PARAM_INT);
             $stmt->bindValue(':pAmountUnit', $shoppinglist->getAmountUnit(), \PDO::PARAM_STR);
             $stmt->bindValue(':pCreated', $shoppinglist->getShoppingListCreated(), \PDO::PARAM_STR);
             $stmt->bindValue(':pDueDate', $shoppinglist->getShoppingListDueDate(), \PDO::PARAM_INT);
             $stmt->bindValue(':pAccess', $shoppinglist->getAccess(), \PDO::PARAM_INT);
             $result = $stmt->execute();
             if ($result) {
                echo 'succes';
             } else {
                echo 'Query/Stored Procedure syntax error';
             }
         } catch (\PDOException $e){
             echo $e->getMessage();
         }  
     }  
 }