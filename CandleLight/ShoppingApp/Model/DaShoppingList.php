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
     private $conn;

     public function __construct()
     {
         $this->conn = new \ShoppingApp\Model\DataSource();
     }
     public function insert($shoppinglist)
     {
         try{
             $stmt = $this->conn->getConnection()->prepare('CALL shopping_list_insert(@pId, :pName, :pUserId, :pDueDate, :pAccess)');
             $stmt->bindValue(':pName', $shoppinglist->getShoppingListName(), \PDO::PARAM_STR);
             $stmt->bindValue(':pUserId', $shoppinglist->getUserId(), \PDO::PARAM_INT);
             $stmt->bindValue(':pDueDate', $shoppinglist->getShoppingListDueDate(), \PDO::PARAM_INT);
             $stmt->bindValue(':pAccess', $shoppinglist->getAccess(), \PDO::PARAM_INT);
             $result = $stmt->execute();
             if ($result) { echo 'succes'; }
         } catch (\PDOException $e){
             echo $e->getMessage();
         }
     }
     
     public function delete($id)
     {
         try{
             $stmt = $this->conn->getConnection()->prepare('CALL shopping_list_delete(:pId)');
             $stmt->bindValue(':pId', $id, \PDO::PARAM_INT);
             $stmt->execute();
         } catch (\PDOException $e){
             echo $e->getMessage();
         }
     }  

     public function update($shoppinglist)
     {
         try{
             $stmt = $this->conn->getConnection()->prepare('CALL shopping_list_update(:pId, :pName, :pUserId, :pDueDate, :pAccess)');
             $stmt->bindValue(':pId', $shoppinglist->getShoppingListId(), \PDO::PARAM_INT);
             $stmt->bindValue(':pName', $shoppinglist->getShoppingListName(), \PDO::PARAM_STR);
             $stmt->bindValue(':pUserId', $shoppinglist->getUserId(), \PDO::PARAM_INT);
             //$stmt->bindValue(':pOwnerText', $shoppinglist->getOwnerText(), \PDO::PARAM_STR);
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
             $stmt = $this->conn->getConnection()->prepare('CALL shopping_list_update_by_friend(:pId, :pFriendsText, :pLastUpdatedBy)');
             $stmt->bindValue(':pId', $shoppinglist->getShoppingListId(), \PDO::PARAM_INT);
             $stmt->bindValue(':pFriendsText', $shoppinglist->getFriendsText(), \PDO::PARAM_STR);
             $stmt->bindValue(':pLastUpdatedBy', $shoppinglist->getLastUpdatedBy(), \PDO::PARAM_INT);
             $stmt->execute();
         } catch (\PDOException $e){
             echo $e->getMessage();
         }
     }

     public function selectOne($id)
     {
         try{
             $stmt = $this->conn->getConnection()->prepare('CALL shopping_list_select_one(:pId)');
             $stmt->bindValue(':pId', $id, \PDO::PARAM_INT);
             $stmt->execute();
             $array = $stmt->fetch(\PDO::FETCH_ASSOC);

             return $array;
         } catch (\PDOException $e){
             echo $e->getMessage();
         }
     }

     public function selectAll()
     {
         try{
             $stmt = $this->conn->getConnection()->prepare('CALL shopping_list_select_all()');
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
             $stmt = $this->conn->getConnection()->prepare('CALL shopping_list_select_by_user(:pId)');
             $stmt->bindValue(':pId', $id, \PDO::PARAM_INT);
             $stmt->execute();
             $array = $stmt->fetchAll();
             return $array;
         } catch (\PDOException $e){
             echo $e->getMessage();
         }
     }
 }