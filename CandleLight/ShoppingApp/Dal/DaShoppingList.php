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
             $stmt = $conn->prepare('CALL shopping_list_insert(@pId, :pName, :pUserId, :pCreated, :pDueDate, :pAccess)');
             $stmt->bindValue(':pName', $shoppinglist->getShoppingListName(), \PDO::PARAM_STR);
             $stmt->bindValue(':pUserId', $shoppinglist->getUserId(), \PDO::PARAM_INT);
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
     
     public static function delete($shoppinglist)
     {
         try{
             $conn = \ShoppingApp\Dal\DataSource::getConnection();
             $stmt = $conn->prepare('CALL shopping_list_delete(:pId)');
             $stmt->bindValue(':pId', $shoppinglist->getShoppingListId());
             $stmt->execute();
         } catch (\PDOException $e){
             echo $e->getMessage();
         }
     }  

     public static function update($shoppinglist)
     {
         try{
             $conn = \ShoppingApp\Dal\DataSource::getConnection();
             $stmt = $conn->prepare('CALL shopping_list_update(:pId, :pName, :pUserId, :pDueDate, :pAccess)');
             $stmt->bindValue(':pId', $shoppinglist->getShoppingListId(), \PDO::PARAM_INT);
             $stmt->bindValue(':pName', $shoppinglist->getShoppingListName(), \PDO::PARAM_STR);
             $stmt->bindValue(':pUserId', $shoppinglist->getUserId(), \PDO::PARAM_INT);
             $stmt->bindValue(':pDueDate', $shoppinglist->getShoppingListDueDate(), \PDO::PARAM_INT);
             $stmt->bindValue(':pAccess', $shoppinglist->getAccess(), \PDO::PARAM_INT);
             $stmt->execute();
         } catch (\PDOException $e){
             echo $e->getMessage();
         }
     }

     public static function selectOne($shoppinglist)
     {
         try{
             $conn = \ShoppingApp\Dal\DataSource::getConnection();
             $stmt = $conn->prepare('CALL shopping_list_select_one(:pId)');
             $stmt->bindValue(':pId', $shoppinglist->getShoppingListId(), \PDO::PARAM_INT);
             $stmt->execute();
             $array = $stmt->fetch(\PDO::FETCH_ASSOC);
             $shoppinglist->setShoppingListId($array['shopping_list_id']);
             $shoppinglist->setShoppingListName($array['shopping_list_name']);
             $shoppinglist->setUserId($array['user_id']);
             $shoppinglist->setShoppingListCreated($array['shopping_list_created']);
             $shoppinglist->setShoppingListDueDate($array['shopping_list_due_date']);
             $shoppinglist->setShoppingListUpdated($array['shopping_list_updated']);
             $shoppinglist->setAccess($array['access']);
         } catch (\PDOException $e){
             echo $e->getMessage();
         }
     }

     public static function selectAll()
     {
         try{
             $conn = \ShoppingApp\Dal\DataSource::getConnection();
             $stmt = $conn->prepare('CALL shopping_list_select_all()');
             $stmt->execute();
             $array = $stmt->fetchAll();

             return $array;
         } catch (\PDOException $e){
             echo $e->getMessage();
         }
     }
 }