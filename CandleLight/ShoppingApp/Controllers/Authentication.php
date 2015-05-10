<?php
namespace ShoppingApp\Controllers;
session_start();
class Authentication
{
    private $login;

    /**
     * @param mixed $email
     */


    public function __construct()
    {
        $this->login = new \ShoppingApp\Model\DaUser();
    }

    public function login()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        if ($_POST['token'] == $_SESSION['token']) {
            if ($this->login->checkPassword($email, $password)) {
                $_SESSION['user'] = $email;
                header("Location: /app/");
                die();
            } else {
                $_SESSION['message'] = 'e-mail or password is not valid';
                header("Location: /");
                die();
            }
        } else {
            $_SESSION['message'] = 'token invalid or corrupted';
            header("Location: /");
            die();
        }
    }
    public function logout(){
        session_destroy();
        header("Location: ../templates/index.php");
        die();
    }
}

?>
