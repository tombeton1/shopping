<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 24/04/2015
 * Time: 17:16
 */

namespace ShoppingApp\Bo;


class Friends {
    private $friendsId;
    private $userInviter;
    private $userInvitee;

    function __construct()
    {
    }


    /**
     * @return mixed
     */
    public function getFriendsId()
    {
        return $this->friendsId;
    }

    /**
     * @param mixed $friendsId
     */
    public function setFriendsId($friendsId)
    {
        $this->friendsId = $friendsId;
    }

    /**
     * @return mixed
     */
    public function getUserInviter()
    {
        return $this->userInviter;
    }

    /**
     * @param mixed $userInviter
     */
    public function setUserInviter($userInviter)
    {
        $this->userInviter = $userInviter;
    }

    /**
     * @return mixed
     */
    public function getUserInvitee()
    {
        return $this->userInvitee;
    }

    /**
     * @param mixed $userInvitee
     */
    public function setUserInvitee($userInvitee)
    {
        $this->userInvitee = $userInvitee;
    }



}