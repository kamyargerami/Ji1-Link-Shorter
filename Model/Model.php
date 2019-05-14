<?php


namespace Model;


use Controller\Config;
use PDO;

class Model
{
    public $connection;

    public function __construct()
    {
        $this->connection = $this->makeConnection();
    }

    public function makeConnection()
    {
        $DB = new PDO('mysql:host=' . Config::$mysqlHost . ';dbname=' . Config::$databaseName, Config::$databaseUser, Config::$databasePassword);
        $DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $DB;
    }

    public function __destruct()
    {
        $this->connection = null;
    }
}