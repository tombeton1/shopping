<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 24/04/2015
 * Time: 17:11
 */

namespace ShoppingApp\Bo;


class User implements \JsonSerializable
{
    private $userId;
    private $firstName;
    private $lastName;
    private $country;
    private $email;
    private $password;

    function __construct()
    {
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
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
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
    public function getRelationAccepted()
    {
        return $this->relationAccepted;
    }

    /**
     * @param mixed $relationAccepted
     */
    public function setRelationAccepted($relationAccepted)
    {
        $this->relationAccepted = $relationAccepted;
    }

    public function JsonSerialize()
    {
        $vars = get_object_vars($this);
        return $vars;
    }
}