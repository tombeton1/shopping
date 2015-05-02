<?php

namespace ShoppingApp\Controllers;
include_once '../../vendor/autoload.php';

class Authentication
{
    public $login;
    public $email;
    public $password;
    public $message;

    public function __construct($email, $password)
    {
        $this->login = new \ShoppingApp\Model\MoUser();
        $this->email = $email;
        $this->password = $password;
    }

    public function checkLogin()
    {
        if ($_POST['token'] == $_SESSION['token']) {
            if ($this->login->checkPassword($this->email, $this->password)) {
                $_SESSION['user'] = $this->email;
                header("Location: ../View/profile.php");
                die();
            } else {
                $_SESSION['message'] = 'e-mail or password is not valid';
                header("Location: ../View/index.php");
                die();
            }
        } else {
            $_SESSION['message'] = 'token invalid or corrupted';
            header("Location: ../View/index.php");
            die();
        }
    }
}

?>
