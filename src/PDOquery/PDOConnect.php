<?php
namespace App\PDOquery;

use PDO;
use PDOException;

class PDOConnect
{
    const HOST = 'localhost';

    private $pdo;

    /**
     * PDOConnect constructor.
     * @param $dbname
     * @param $username
     * @param $pass
     */
    public function __construct($dbname, $username, $pass)
    {

        try
        {
            $this->pdo = new PDO("mysql:dbname=$dbname;host=". self::HOST, $username, $pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (PDOException $e)
        {
            echo "NOT connection to database!";
            exit();
        }
    }

    /**
     * @return PDO
     */
    public function getPDO()
    {
        return $this->pdo;
    }

    /**
     * @return array
     */
    public function getUsers(): array
    {
        try
        {
            $query = "SELECT * FROM Users;";
            $sth = $this->pdo->query($query);
            $sth->execute();
        }
        catch (\PDOException $e)
        {
            echo "Ошибка запроса " . $e->getMessage();
            exit();
        }

        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param $id
     * @return array
     */
    public function getUser($id)
    {
        try
        {
            $query = "SELECT id, name, lastname, email FROM Users WHERE id = :id";
            $sth = $this->pdo->prepare($query);
            $sth->bindParam(':id', $id);
            $sth->execute();
        }
        catch (\PDOException $e)
        {
            echo "Ошибка запроса " . $e->getMessage();
            exit();
        }

        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param $name
     * @return array
     */
    public function getUserByName($name)
    {
        try
        {
            $query = "SELECT name, lastname, email FROM Users WHERE name = :name";
            $sth = $this->pdo->prepare($query);
            $sth->bindParam(':name', $name);
            $sth->execute();
        }
        catch (\PDOException $e)
        {
            echo "Ошибка запроса " . $e->getMessage();
            exit();
        }

        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param $name
     * @param $lastname
     * @param $email
     * @return bool
     */
    public function addUser($name, $lastname, $email)
    {
        try
        {
            $query = "INSERT INTO Users (name, lastname, email) VALUES (:name, :lastname, :email)";
            $sth = $this->pdo->prepare($query);
            $sth->bindParam(':name', $name);
            $sth->bindParam(':lastname', $lastname);
            $sth->bindParam(':email', $email);

        }
        catch (\PDOException $e)
        {
            echo "Ошибка запроса " . $e->getMessage();
            exit();
        }

        return $sth->execute();
    }

    /**
     * @param $id
     * @return bool
     */
     public function deleteUser($id)
     {
         try
         {
             $query = "DELETE FROM Users WHERE id = :id";
             $sth = $this->pdo->prepare($query);
             $sth->bindParam('id', $id);

         }
         catch (\PDOException $e)
         {
             echo "Неудалось удалить запись " . $e->getMessage();
             exit();
         }

         return $sth->execute();
     }

    /**
     * @param $name
     * @return mixed
     */
     public function getIdByName($name)
     {
         try
         {
             $query = "SELECT id FROM Users WHERE name = :name";
             $sth = $this->pdo->prepare($query);
             $sth->bindParam(':name', $name);
             $sth->execute();
         }
         catch (\PDOException $e)
         {
             echo "Ошибка запроса " . $e->getMessage();
             exit();
         }

         return $sth->fetch();
     }
}