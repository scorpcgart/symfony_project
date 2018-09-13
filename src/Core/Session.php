<?php
namespace App\Core;

class Session
{
    const SESSION_STARTED = true;
    const SESSION_NOT_STARTED =false;

    private $sessionStatus = self::SESSION_NOT_STARTED;

    public function startSession()
    {
        if($this->sessionStatus == self::SESSION_NOT_STARTED){
            session_start();
        }
        return $this->sessionStatus;
    }

    public function setSession($name, $value)
    {
        return $_SESSION[$name] = $value;
    }


    /**
     * @param $name
     * @return mixed
     */
    public function isSession($name)
    {
        if(isset($_SESSION[$name])) {
            return true;
        }
        return false;
    }

    public function getValueSession($name)
    {
        return $_SESSION[$name];
    }


}