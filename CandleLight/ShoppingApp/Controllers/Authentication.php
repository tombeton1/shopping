<?php
namespace ShoppingApp\Controllers;
session_start();
class Authentication
{
    private $login;
    protected $email;
    protected $password;
    protected $token;

    /**
     * @param mixed $email
     */


    public function __construct($token, $email, $password)
    {
        $this->login = new \ShoppingApp\Model\DaUser();
        $this->token = $token;
        $this->email = $email;
        $this->password = $password;
    }

    public function login()
    {
        if ($this->token == $_SESSION['token']) {
            if ($this->login->checkPassword($this->email, $this->password)) {
                $this->login->
                $_SESSION['user'] = $this->email;
                header("Location: /CandleLight/app/");
                die();
            } else {
                $_SESSION['message'] = 'e-mail or password is not valid';
                header("Location: /CandleLight/");
                die();
            }
        } else {
            $_SESSION['message'] = 'token invalid or corrupted';
            header("Location: /CandleLight/");
            die();
        }
    }
    public static  function logout(){
        session_destroy();
        header("Location: /CandleLight/");
        die();
    }
}

?>
