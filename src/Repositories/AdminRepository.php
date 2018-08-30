<?php
namespace App\Repositories;

use PDO;
use App\Db\DbModel;

class AdminRepository
{
    private $pdo;

    public function __construct(DbModel $dbModel)
    {
        $this->pdo = $dbModel;
    }

    public function checkUser($login)
    {
        $query = "SELECT name, password FROM Adminstrators WHERE login = :login";

        $this->pdo->query($query);
        $this->pdo->bind(':login', $login);

        return $this->pdo->getFetch();
    }
}
