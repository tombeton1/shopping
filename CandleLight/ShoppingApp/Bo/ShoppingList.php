<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 24/04/2015
 * Time: 17:02
 */

namespace ShoppingApp\Bo;


class ShoppingList {
    private $shoppingListName;
    private $shoppingListId;
    private $listFriends;
    private $userId;
    private $listProducts;
    private $amount;
    private $amountUnit;
    private $shoppingListCreated;
    private $shoppingListDueDate;
    private $shoppingListUpdated;

    function __construct()
    {
    }


    /**
     * @return mixed
     */
    public function getShoppingListName()
    {
        return $this->shoppingListName;
    }

    /**
     * @param mixed $shoppingListName
     */
    public function setShoppingListName($shoppingListName)
    {
        $this->shoppingListName = $shoppingListName;
    }

    /**
     * @return mixed
     */
    public function getShoppingListId()
    {
        return $this->shoppingListId;
    }

    /**
     * @param mixed $shoppingListId
     */
    public function setShoppingListId($shoppingListId)
    {
        $this->shoppingListId = $shoppingListId;
    }

    /**
     * @return mixed
     */
    public function getListFriends()
    {
        return $this->listFriends;
    }

    /**
     * @param mixed $listFriends
     */
    public function setListFriends($listFriends)
    {
        $this->listFriends = $listFriends;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return mixed
     */
    public function getListProducts()
    {
        return $this->listProducts;
    }

    /**
     * @param mixed $listProducts
     */
    public function setListProducts($listProducts)
    {
        $this->listProducts = $listProducts;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return mixed
     */
    public function getAmountUnit()
    {
        return $this->amountUnit;
    }

    /**
     * @param mixed $amountUnit
     */
    public function setAmountUnit($amountUnit)
    {
        $this->amountUnit = $amountUnit;
    }

    /**
     * @return mixed
     */
    public function getShoppingListCreated()
    {
        return $this->shoppingListCreated;
    }

    /**
     * @param mixed $shoppingListCreated
     */
    public function setShoppingListCreated($shoppingListCreated)
    {
        $this->shoppingListCreated = $shoppingListCreated;
    }

    /**
     * @return mixed
     */
    public function getShoppingListDueDate()
    {
        return $this->shoppingListDueDate;
    }

    /**
     * @param mixed $shoppingListDueDate
     */
    public function setShoppingListDueDate($shoppingListDueDate)
    {
        $this->shoppingListDueDate = $shoppingListDueDate;
    }

    /**
     * @return mixed
     */
    public function getShoppingListUpdated()
    {
        return $this->shoppingListUpdated;
    }

    /**
     * @param mixed $shoppingListUpdated
     */
    public function setShoppingListUpdated($shoppingListUpdated)
    {
        $this->shoppingListUpdated = $shoppingListUpdated;
    }


}