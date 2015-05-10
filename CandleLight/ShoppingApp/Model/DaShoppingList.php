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
         try {
             $conn = \ShoppingApp\Model\DataSource::getConnection();
             $stmt = $conn->prepare('CALL shopping_list_insert(@pId, :pName, :pUserId, :pCreated, :pDueDate, :pAccess)');
             $stmt->bindValue(':pName', $shoppinglist->getShoppingListName(), \PDO::PARAM_STR);
             $stmt->bindValue(':pUserId', $shoppinglist->getUserId(), \PDO::PARAM_INT);
             $stmt->bindValue(':pCreated', $shoppinglist->getShoppingListCreated(), \PDO::PARAM_STR);
             $stmt->bindValue(':pDueDate', $shoppinglist->getShoppingListDueDate(), \PDO::PARAM_INT);
             $stmt->bindValue(':pAccess', $shoppinglist->getAccess(), \PDO::PARAM_INT);
             $result = $stmt->execute();
             if ($result) {
                echo 'succes';
             }

             $id = $conn->query('select @pId')->fetchColumn();
             $products = $shoppinglist->getListProducts();

             if($products){
                 foreach($products as $product){
                     $stmt = $conn->prepare('CALL product_shopping_list_insert(:pProductId, :pShoppingListId, :pAmount, :pAmountUnit)');
                     $stmt->bindValue(':pProductId', $product['id'], \PDO::PARAM_INT);
                     $stmt->bindValue(':pShoppingListId', $id, \PDO::PARAM_INT);
                     $stmt->bindValue(':pAmount', $product['amount'], \PDO::PARAM_INT);
                     $stmt->bindValue(':pAmountUnit', $product['unit'], \PDO::PARAM_STR);
                     $stmt->execute();
                 }
             }
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
             $stmt = $conn->prepare('CALL shopping_list_update(:pId, :pName, :pUserId, :pDueDate, :pAccess)');
             $stmt->bindValue(':pId', $shoppinglist->getShoppingListId(), \PDO::PARAM_INT);
             $stmt->bindValue(':pName', $shoppinglist->getShoppingListName(), \PDO::PARAM_STR);
             $stmt->bindValue(':pUserId', $shoppinglist->getUserId(), \PDO::PARAM_INT);
             $stmt->bindValue(':pDueDate', $shoppinglist->getShoppingListDueDate(), \PDO::PARAM_INT);
             $stmt->bindValue(':pAccess', $shoppinglist->getAccess(), \PDO::PARAM_INT);
             $stmt->execute();

             $products = $shoppinglist->getListProducts();

             if($products){
                 $stmt = $conn->prepare('CALL product_shopping_list_delete(:pId)');
                 $stmt->bindValue(':pId', $shoppinglist->getShoppingListId(), \PDO::PARAM_INT);
                 $stmt->execute();
                 foreach($products as $product){
                     $stmt = $conn->prepare('CALL product_shopping_list_insert(:pProductId, :pShoppingListId, :pAmount, :pAmountUnit)');
                     $stmt->bindValue(':pProductId', $product['id'], \PDO::PARAM_INT);
                     $stmt->bindValue(':pShoppingListId', $shoppinglist->getShoppingListId(), \PDO::PARAM_INT);
                     $stmt->bindValue(':pAmount', $product['amount'], \PDO::PARAM_INT);
                     $stmt->bindValue(':pAmountUnit', $product['unit'], \PDO::PARAM_STR);
                     $stmt->execute();
                 }
             }
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