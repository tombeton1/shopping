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
            if ($this->login->checkPassword($this->email, $this->password) != FALSE) {
                $this->login->insertToken($this->email);
                $User = $this->login->checkPassword($this->email, $this->password);
                $_SESSION['user'] = $User;
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

    public function tokenPresent()
    {
        $result = false;
        if(isset($_SESSION['token'])){
            $result = true;
        }
        return $result;
    }

    public function validate(){
        return $this->login->checkToken($this->token);
    }

    public function validateKey(){
        return $this->login->checkKey($this->token);
    }
}
?>
