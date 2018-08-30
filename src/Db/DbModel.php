<?php
namespace App\Db;

use PDO;

class DbModel
{
    protected $dbConnection;

    protected $statement;


    /**
     * DbModel constructor.
     * @param DbConnection $dbConnection
     */
    public function __construct(DbConnection $dbConnection)
    {
        $params = new DbParamsDTO();
        $params->setHost('localhost');
        $params->setDbName('twig_test_db');
        $params->setUserName('root');
        $params->setPassword('admin');
        $dbConnection->setParams($params);
        $dbConnection->connect();
        $this->dbConnection = $dbConnection;
    }

    /**
     * @param string $query
     */
    public function query(string $query)
    {
        $this->statement = $this->dbConnection->getConnection()->prepare($query);

        return $this;
    }

    /**
     * @return mixed
     */
    public function execute()
    {
        return $this->statement->execute();
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        $this->execute();

        return $this->statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getFetch()
    {
        $this->execute();

        return $this->statement->fetch(PDO::FETCH_ASSOC);
    }

    public function bind(string $paramName, $value)
    {
        $pdoParamType = \PDO::PARAM_STR;

        if (is_integer($value)) {
            $pdoParamType = \PDO::PARAM_INT;
        }

        $this->statement->bindParam($paramName, $value);

        return $this;
    }

}