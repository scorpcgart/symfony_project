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
        $this->dbConnection = $dbConnection;
    }

    /**
     * @param string $query
     */
    public function query(string $query)
    {
        $this->statement = $this->dbConnection->getConnection()->prepare($query);
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        $this->statement->execute();

        return $this->statement->fetchAll(PDO::FETCH_ASSOC);
    }

}