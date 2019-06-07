<?php

namespace System;

use PDOException;
use PDO;

class Database
{

    public static $instance = null;
    public $connection;
    protected $host = HOST;
    protected $dbName = DB_NAME;
    protected $dbUser = DB_USER;
    protected $dbPass = DB_PASS;
    protected $option = [];
    protected $dsn;



    private function __construct()
    {
        $this->connect();
    }

    public function connect()
    {
        $this->dsn = 'mysql:host='. HOST . ';dbname=' . DB_NAME;
        $this->option = [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
        ];
        try{
            $this->connection = new PDO($this->dsn, DB_USER, DB_PASS,$this->option );
        } catch (PDOException $e){
            echo die('<b>No connection could be made because the target machine actively refused it ! we do fix it as soon as possible .</b>');
        }

    }

    public static  function getInstance()
    {
        if (static::$instance === null){
            static::$instance = new self();
        }

        return static::$instance;
    }

}