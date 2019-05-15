<?php


namespace Model;


use Controller\Config;
use PDO;

abstract class Model
{
    public $connection;
    public $table;

    public function __construct()
    {
        $this->connection = $this->makeConnection();
    }

    public function __destruct()
    {
        $this->connection = null;
    }

    public function makeConnection()
    {
        $DB = new PDO('mysql:host=' . Config::$mysqlHost . ';dbname=' . Config::$databaseName, Config::$databaseUser, Config::$databasePassword);
        $DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $DB;
    }

    public function fetch(array $where)
    {
        $sql = '';
        $loop = 0;

        foreach ($where as $field => $value) {
            $sql .= ($loop === 0) ? "SELECT * FROM `{$this->table}` WHERE `{$field}` LIKE '{$value}'" : " And `{$field}` LIKE '{$value}'";
            $loop++;
        }

        $query = $this->connection->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function insert(array $data)
    {
        $values = '';
        $fields = '`id`,';

        $loop = 0;
        foreach (array_values($data) as $value) {
            $values .= "'{$value}'";
            $loop++;
            $values .= $loop < count(array_values($data)) ? ',' : '';
        }

        $loop = 0;
        foreach (array_keys($data) as $field) {
            $fields .= "`{$field}`";
            $loop++;
            $fields .= $loop < count(array_values($data)) ? ',' : '';
        }
        $sql = "INSERT INTO `{$this->table}` ({$fields}) VALUES (NULL, {$values})";

        $query = $this->connection->prepare($sql);
        return $query->execute();
    }

    public function delete()
    {

    }

    public function update()
    {

    }
}