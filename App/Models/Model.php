<?php

namespace Models;

use System\Application;
use System\Database;

class Model
{
    public $app;
    public static $db;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public static function getAll()
    {
        $sql = "SELECT * FROM " . static::$tableName;
        static::$db = Database::getInstance();
        $stmt = static::$db->connection->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll();
        return $data;
    }

    public static function getBy($key, $value)
    {
        $sql = "SELECT * FROM " . static::$tableName . " WHERE $key = :" . $key;
        static::$db = Database::getInstance();
        $stmt = static::$db->connection->prepare($sql);
        static::$db->connection->prepare($sql);
        $stmt->execute(array(":$key" => $value));
        $data = $stmt->fetchAll();
        return array_shift($data);
    }

    public static function query($sql)
    {
        static::$db = Database::getInstance();
        $stmt = static::$db->connection->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll();
//        if ($data instanceof \stdClass){
//            return $data;
//        } else {
//            return array_shift($data);
//        }
        return $data;

    }
    
    public static function update($columns = [], $values = [], $where)
    {

        static::$db = Database::getInstance();

        $value = array_combine($columns, $values);

        $sql = "UPDATE " . static::$tableName . " SET " . static::setValue($columns) . " WHERE $where";
        $stmt = static::$db->connection->prepare($sql);
        $stmt->execute($value);
        return static::$db->connection->lastInsertId();
    }

    public static function insert($columns = [], $values = [])
    {
        static::$db = Database::getInstance();

        $value = array_combine($columns, $values);

        $sql = "INSERT INTO  " . static::$tableName . " SET " . static::setValue($columns);
        $stmt = static::$db->connection->prepare($sql);
        $stmt->execute($value);
        return static::$db->connection->lastInsertId();
    }

    public static function delete($where)
    {
        $sql = "DELETE FROM " . static::$tableName . " WHERE $where";

        static::$db = Database::getInstance();
        $stmt = static::$db->connection->prepare($sql);
        $stmt->execute();
    }

    public static function setValue($columns)
    {
        $set = '';

        foreach ($columns as $column) {
            $set .= "$column = :$column, ";
        }

        $set = trim($set, ', ');

        return $set;
    }

}