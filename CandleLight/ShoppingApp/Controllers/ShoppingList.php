<?php
/**
 * Created by PhpStorm.
 * User: Oualid
 * Date: 2/06/2015
 * Time: 17:44
 */

namespace ShoppingApp\Controllers;

class ShoppingList{
    private $shoppingList;

    public function __construct()
    {
        $this->shoppingList = new \ShoppingApp\Model\DaShoppingList();
    }

    public function insertList($shoppinglist)
    {
        return json_encode($this->shoppingList->insert($shoppinglist));
    }

    public function getList($id)
    {
        return json_encode($this->shoppingList->selectOne($id));
    }

    public function getListsByUser($id)
    {
        return json_encode($this->shoppingList->selectByUser($id));
    }

    public function deleteList($id)
    {
        return json_encode($this->shoppingList->delete($id));
    }

    public function updateList($shoppinglist)
    {
        return json_encode($this->shoppingList->update($shoppinglist));
    }

    public function insertText($shoppinglist)
    {
        return json_encode($this->shoppingList->insertText($shoppinglist));
    }
}
