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

    public function addArticle($title, $text)
    {
        $query = "INSERT INTO Articles (title, text) VALUES (:title, :text)";

        $this->pdo->query($query);
        $this->pdo->bind(':title', $title);
        $this->pdo->bind(':text', $text);

        return $this->pdo->execute();
    }

    public function getArticles()
    {
        $query = "SELECT title, text FROM Articles";

        $this->pdo->query($query);
        $this->pdo->execute();

        return $this->pdo->getAll();

    }
}
