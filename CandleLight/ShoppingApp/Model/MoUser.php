<?php
/**
 * Created by PhpStorm.
 * User: lenny
 * Date: 30/04/15
 * Time: 18:39
 */
namespace ShoppingApp\Model;
include_once '../../vendor/autoload.php';

class MoUser
{

    public function checkPassword($email, $password)
    {
        return \ShoppingApp\Dal\DaUser::checkPassword($email, $password);
    }

    public function selectAllUsers()
    {
        return json_encode(\ShoppingApp\Dal\DaUser::selectAll());
    }

    public function insertUser($firstname, $lastname, $email, $password, $country)
    {
        $User = new \ShoppingApp\Bo\User();
        $User->setEmail($email);
        $User->setFirstName($firstname);
        $User->setLastName($lastname);
        $User->setPassword($password);
        $User->setCountry($country);
        \ShoppingApp\Dal\DaUser::insert($User);
    }
}