<?php

namespace ShoppingApp\Controllers;
include_once '../../vendor/autoload.php';
session_start();
class Authentication
{
    private $login;
    private $email;
    private $password;

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function __construct()
    {
        $this->login = new \ShoppingApp\Model\MoUser();
    }

    public function login()
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
    public function logout(){
        session_destroy();
        header("Location: ../View/index.php");
        die();
    }
}

?>
