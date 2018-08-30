<?php
namespace App\Db;

use PDO;

class DbConnection
{
    protected $connection;

    protected $dbParamsDTO;

    public function setParams(DbParamsDTO $dbParamsDTO)
    {
        $this->dbParamsDTO = $dbParamsDTO;
    }

    public function connect()
    {
        $params = $this->dbParamsDTO;

        $dns = sprintf(
            'mysql:dbname=%s;host=%s',
            $params->getDbName(),
            $params->getHost()
        );
        $this->connection = new PDO($dns, $params->getUserName(), $params->getPassword());

        return $this;
    }

    public function getConnection(): PDO
    {
        return $this->connection;
    }
}