<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 21/04/2015
 * Time: 23:22
 */

namespace ShoppingApp\Bo;


class Group {
    private $groupId;
    private $groupEmail;
    private $groupName;
    private$groupCountry;

    function __construct()
    {
    }


    /**
     * @return mixed
     */
    public function getGroupId()
    {
        return $this->groupId;
    }

    /**
     * @param mixed $groupId
     */
    public function setGroupId($groupId)
    {
        $this->groupId = $groupId;
    }

    /**
     * @return mixed
     */
    public function getGroupEmail()
    {
        return $this->groupEmail;
    }

    /**
     * @param mixed $groupEmail
     */
    public function setGroupEmail($groupEmail)
    {
        $this->groupEmail = $groupEmail;
    }

    /**
     * @return mixed
     */
    public function getGroupName()
    {
        return $this->groupName;
    }

    /**
     * @param mixed $groupName
     */
    public function setGroupName($groupName)
    {
        $this->groupName = $groupName;
    }

    /**
     * @return mixed
     */
    public function getGroupCountry()
    {
        return $this->groupCountry;
    }

    /**
     * @param mixed $groupCountry
     */
    public function setGroupCountry($groupCountry)
    {
        $this->groupCountry = $groupCountry;
    }


}