<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 24/04/2015
 * Time: 17:16
 */

namespace ShoppingApp\Bo;


class Friends implements \JsonSerializable {

    private $userInviter;
    private $userInvitee;
    private $relationAccepted;

    function __construct()
    {
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