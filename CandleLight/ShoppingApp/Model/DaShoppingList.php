<?php
/**
 * Created by PhpStorm.
 * User: Oualid
 * Date: 25/04/2015
 * Time: 18:57
 */

 namespace ShoppingApp\Model;

 class DaShoppingList
 {
     public function insert($shoppinglist)
     {
         try{
             $conn = \ShoppingApp\Model\DataSource::getConnection();
             $stmt = $conn->prepare('CALL shopping_list_insert(@pId, :pName, :pUserId, :pOwnerText, :pCreated, :pDueDate, :pAccess)');
             $stmt->bindValue(':pName', $shoppinglist->getShoppingListName(), \PDO::PARAM_STR);
             $stmt->bindValue(':pUserId', $shoppinglist->getUserId(), \PDO::PARAM_INT);
             $stmt->bindValue(':pOwnerText', $shoppinglist->getOwnerText(), \PDO::PARAM_STR);
             $stmt->bindValue(':pCreated', $shoppinglist->getShoppingListCreated(), \PDO::PARAM_STR);
             $stmt->bindValue(':pDueDate', $shoppinglist->getShoppingListDueDate(), \PDO::PARAM_INT);
             $stmt->bindValue(':pAccess', $shoppinglist->getAccess(), \PDO::PARAM_INT);
             $result = $stmt->execute();
             if ($result) { echo 'succes'; }
         } catch (\PDOException $e){
             echo $e->getMessage();
         }
     }
     
     public function delete($shoppinglist)
     {
         try{
             $conn = \ShoppingApp\Model\DataSource::getConnection();
             $stmt = $conn->prepare('CALL shopping_list_delete(:pId)');
             $stmt->bindValue(':pId', $shoppinglist->getShoppingListId());
             $stmt->execute();
         } catch (\PDOException $e){
             echo $e->getMessage();
         }
     }  

     public function update($shoppinglist)
     {
         try{
             $conn = \ShoppingApp\Model\DataSource::getConnection();
             $stmt = $conn->prepare('CALL shopping_list_update(:pId, :pName, :pUserId, :pOwnerText, :pDueDate, :pAccess)');
             $stmt->bindValue(':pId', $shoppinglist->getShoppingListId(), \PDO::PARAM_INT);
             $stmt->bindValue(':pName', $shoppinglist->getShoppingListName(), \PDO::PARAM_STR);
             $stmt->bindValue(':pUserId', $shoppinglist->getUserId(), \PDO::PARAM_INT);
             $stmt->bindValue(':pOwnerText', $shoppinglist->getOwnerText(), \PDO::PARAM_STR);
             $stmt->bindValue(':pDueDate', $shoppinglist->getShoppingListDueDate(), \PDO::PARAM_INT);
             $stmt->bindValue(':pAccess', $shoppinglist->getAccess(), \PDO::PARAM_INT);
             $stmt->execute();
         } catch (\PDOException $e){
             echo $e->getMessage();
         }
     }

     public function updateByFriend($shoppinglist)
     {
         try{
             $conn = \ShoppingApp\Model\DataSource::getConnection();
             $stmt = $conn->prepare('CALL shopping_list_update_by_friend(:pId, :pFriendsText, :pLastUpdatedBy)');
             $stmt->bindValue(':pId', $shoppinglist->getShoppingListId(), \PDO::PARAM_INT);
             $stmt->bindValue(':pFriendsText', $shoppinglist->getFriendsText(), \PDO::PARAM_STR);
             $stmt->bindValue(':pLastUpdatedBy', $shoppinglist->getLastUpdatedBy(), \PDO::PARAM_INT);
             $stmt->execute();
         } catch (\PDOException $e){
             echo $e->getMessage();
         }
     }

     public function selectOne($shoppinglist)
     {
         try{
             $conn = \ShoppingApp\Model\DataSource::getConnection();
             $stmt = $conn->prepare('CALL shopping_list_select_one(:pId)');
             $stmt->bindValue(':pId', $shoppinglist->getShoppingListId(), \PDO::PARAM_INT);
             $stmt->execute();
             $array = $stmt->fetch(\PDO::FETCH_ASSOC);
             $shoppinglist->setShoppingListId($array['shopping_list_id']);
             $shoppinglist->setShoppingListName($array['shopping_list_name']);
             $shoppinglist->setUserId($array['user_id']);
             $shoppinglist->setOwnerText($array['owner_text']);
             $shoppinglist->setFriendsText($array['friends_text']);
             $shoppinglist->setShoppingListCreated($array['shopping_list_created']);
             $shoppinglist->setShoppingListDueDate($array['shopping_list_due_date']);
             $shoppinglist->setShoppingListUpdated($array['shopping_list_updated']);
             $shoppinglist->setAccess($array['access']);
         } catch (\PDOException $e){
             echo $e->getMessage();
         }
     }

     public function selectAll()
     {
         try{
             $conn = \ShoppingApp\Model\DataSource::getConnection();
             $stmt = $conn->prepare('CALL shopping_list_select_all()');
             $stmt->execute();
             $array = $stmt->fetchAll();

             return $array;
         } catch (\PDOException $e){
             echo $e->getMessage();
         }
     }

     public function selectByUser($id)
     {
         try{
             $conn = \ShoppingApp\Model\DataSource::getConnection();
             $stmt = $conn->prepare('CALL shopping_list_select_by_user(:pId)');
             $stmt->bindValue(':pId', $id, \PDO::PARAM_INT);
             $stmt->execute();
             $array = $stmt->fetchAll();

             return $array;
         } catch (\PDOException $e){
             echo $e->getMessage();
         }
     }
 }