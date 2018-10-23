<?php

namespace ToDo\Db;

use PDO;
use ToDo\Item\Item;

class ItemTable implements ItemTableInterface
{
    private $connection;

    public function __construct($host, $dbName, $username, $password)
    {
        $dsn = 'mysql:host=' . $host . ';dbname=' . $dbName;
        $this->connection = new \PDO($dsn, $username, $password);
    }


    public function insert($name, $deadline)
    {
        $sql = 'INSERT INTO items (name, completed, deadline)';
        $sql .= ' VALUES (:name, :completed, :deadline)';
        $stmt = $this->connection->prepare($sql);
        $query = $stmt->execute(array(
            "name" => $name,
            "completed" => 0,
            "deadline" => $deadline
        ));
        return $query;
    }

    public function fetch($id)
    {
        $selectQuery = $this->connection->prepare("SELECT * FROM items WHERE id=?");
        $selectQuery->execute([$id]);
        $result = $selectQuery->fetchAll(PDO::FETCH_CLASS);
        return $result;
    }

    public function fetchId($id)
    {
        $selectQuery = $this->connection->prepare("SELECT name, deadline FROM items WHERE id=?");
        $a = $selectQuery->execute([$id]);
        $selectQuery->setFetchMode(PDO::FETCH_CLASS, Item::class);
        $result = $selectQuery->fetch();
        return $result;
    }


    public function findAllNotCompletedItems()
    {
        $sql = "SELECT * FROM items WHERE completed!=1";
        $allItems = $this->connection->query($sql)->fetchAll(PDO::FETCH_CLASS, Item::class);
        return $allItems;
    }

    public function updateItemCompleted($id, $completed)
    {
        $selectQuery = $this->connection->prepare("SELECT * FROM items WHERE id=?");
        $selectQuery->execute([$id]);
        $result = $selectQuery->fetch(PDO::FETCH_ASSOC);
        $updateQuery = "UPDATE items SET name=?, completed=? WHERE id=?";
//        $updateQuery->execute([$id]);
        $stmt = $this->connection->prepare($updateQuery);
//        var_dump($stmt);
//        var_dump($id);
//        var_dump($completed);
        $stmt->execute([$result['name'], $completed, $id]);
        return true;
    }

    public function editItem($id, $name, $deadline)
    {
        $selectQuery = $this->connection->prepare("SELECT * FROM items WHERE id=?");
        $selectQuery->execute([$id]);
        $result = $selectQuery->fetchAll(PDO::FETCH_CLASS);
        $updateQuery = "UPDATE items SET name=?, completed=?, deadline=? WHERE id=?";
        $stmt = $this->connection->prepare($updateQuery);
        $stmt->execute([$name, $result[0]->completed, $deadline, $id]);
        return true;
    }

    public function sortAllItems($sort)
    {
        $sql = "SELECT * FROM items ORDER BY deadline $sort";
//        var_dump($sql);
        $allItems = $this->connection->query($sql)->fetchAll(PDO::FETCH_CLASS, Item::class);
//        var_dump($allItems);
        return $allItems;
    }

    public function sortAllItemsD($completed)
    {
//        var_dump($completed);
        if (!$completed) {
            $sql = "SELECT * FROM items ORDER BY deadline DESC";
        } else {

            $sql = "SELECT * FROM items WHERE completed!=1 ORDER BY deadline DESC";
        }
        $allItems = $this->connection->query($sql)->fetchAll(PDO::FETCH_CLASS, Item::class);
        return $allItems;
    }

    public function findAllItems()
    {
        $sql = "SELECT * FROM items";
        $allItems = $this->connection->query($sql)->fetchAll(PDO::FETCH_CLASS, Item::class);
//var_dump($allItems);exit();
        return $allItems;
    }

}