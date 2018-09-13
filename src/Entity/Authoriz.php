<?php
namespace App\Entity;

class Authoriz
{
    /**
     * @var string
     */
    private $login;

    /**
     * @var string
     */
    private $password;

    /**
     * @param $login
     * @return $this
     */
    public function setLogin($login)
    {
        $this->login = $login;

    }

    /**
     * @param $password
     * @return mixed
     */
    public function setPassword($password)
    {
        $this->password =  $password;

    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;

    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }
}