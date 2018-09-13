<?php
namespace App\Core;

use App\Core\Session;

class Autorization
{
    private $session;


    public function Autoriz($login)
    {
        session_start();
        $this->session = $_SESSION['name'] = $login;
    }

    public function checkAutorization($login)
    {
        if(isset($this->session)){
            echo "пользователь авторизован";
        } else {
            echo "не авторизован.";
        }
    }



}