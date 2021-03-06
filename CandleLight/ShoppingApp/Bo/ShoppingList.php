<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 24/04/2015
 * Time: 17:02
 */

namespace ShoppingApp\Bo;


class ShoppingList implements \JsonSerializable
{
    private $shoppingListName;
    private $shoppingListId;
    private $userId;
    private $ownerText;
    private $friendsText;
    private $listProducts;
    private $shoppingListCreated;
    private $shoppingListDueDate;
    private $shoppingListUpdated;
    private $access;
    private $lastUpdatedBy;

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
    public function getOwnerText()
    {
        return $this->ownerText;
    }

    /**
     * @param mixed $ownerText
     */
    public function setOwnerText($ownerText)
    {
        $this->ownerText = $ownerText;
    }

    /**
     * @return mixed
     */
    public function getFriendsText()
    {
        return $this->friendsText;
    }

    /**
     * @param mixed $friendsText
     */
    public function setFriendsText($friendsText)
    {
        $this->friendsText = $friendsText;
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

    /**
     * @return mixed
     */
    public function getAccess()
    {
        return $this->access;
    }

    /**
     * @param mixed $access
     */
    public function setAccess($access)
    {
        $this->access = $access;
    }

    /**
     * @return mixed
     */
    public function getLastUpdatedBy()
    {
        return $this->lastUpdatedBy;
    }

    /**
     * @param mixed $lastUpdatedBy
     */
    public function setLastUpdatedBy($lastUpdatedBy)
    {
        $this->lastUpdatedBy = $lastUpdatedBy;
    }

    public function JsonSerialize()
    {
        $vars = get_object_vars($this);

        return $vars;
    }


}