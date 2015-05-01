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

    public static function checkPassword($email, $password)
    {
      return \ShoppingApp\Dal\DaUser::checkPassword($email, $password);
    }
}