<?php
/**
 * Created by PhpStorm.
 * User: scorp
 * Date: 26.08.18
 * Time: 22:08
 */

namespace App\Repositories;

use PDO;
use App\Db\DbModel;

class UserRepository
{
    private $pdo;

    public function __construct(DbModel $dbModel)
    {
        $this->pdo = $dbModel;
    }

    public function getUsers($userId = null)
    {
        if (is_null($userId)) {
            $query = "SELECT * FROM Users;";
        } else {
            $userId = (int)$userId;
            $query = "SELECT id, name, lastname, email FROM Users WHERE id = :id";

        }

        $this->pdo->query($query);
        $this->pdo->bind(':id', $userId, PDO::PARAM_INT);

        return $this->pdo->getAll();

    }

    public function addUser($name, $lastname, $email)
    {
        $query = "INSERT INTO Users (name, lastname, email) VALUES (:name, :lastname, :email)";

        $this->pdo->query($query);
        $this->pdo->bind(':name', $name);
        $this->pdo->bind(':lastname', $lastname);
        $this->pdo->bind(':email', $email);

        return $this->pdo->execute();
    }

    public function deleteUser($userId)
    {
        $query = "DELETE FROM Users WHERE id = :id";

        $this->pdo->query($query);
        $this->pdo->bind(':id', $userId);

        return $this->pdo->execute();
    }

    public function getNameUserById($userId)
    {
        $query = "SELECT name, lastname FROM Users WHERE id = :id";

        $this->pdo->query($query);
        $this->pdo->bind(':id', $userId, PDO::PARAM_INT);

        return $this->pdo->getAll();
    }

}