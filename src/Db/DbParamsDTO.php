<?php
namespace App\Db;

class DbParamsDTO
{
    protected $host;

    protected $dbname;

    protected $username;

    protected $password;

    public function setHost(string $host)
    {
        $this->host = $host;

        return $this;
    }

    public function setDbName(string $dbName)
    {
        $this->dbname = $dbName;

        return $this;
    }

    public function setUserName(string $userName)
    {
        $this->username = $userName;

        return $this;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;

        return $this;
    }

    public function getHost(): string
    {
        return $this->host;
    }
    public function getDbName(): string
    {
        return $this->dbname;
    }

    public function getUserName(): string
    {
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}