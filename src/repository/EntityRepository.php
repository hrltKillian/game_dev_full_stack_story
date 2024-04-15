<?php

require_once "../config/config.php";

class EntityRepository
{
    public static function connect() : PDO
    {
        $string = "mysql:host=".DBHOST.";dbname=".DBNAME;
        $pdo = new PDO($string, DBUSER, DBPWD);
        return $pdo;
    }

    /**
     * Get the PDO type from a string
     * @param string $type ex : "str"
     * @return int ex : PDO::PARAM_STR
     */

    public static function getPDOType(string $type) : int
    {
        switch ($type) {
            case 'str':
                return PDO::PARAM_STR;
                break;
            case 'int':
                return PDO::PARAM_INT;
                break;
            case 'bool':
                return PDO::PARAM_BOOL;
                break;
            case 'null':
                return PDO::PARAM_NULL;
                break;
            default:
                return PDO::PARAM_STR;
                break;
        }
    }

    /**
     * Get all entities from a table
     * @param string $table ex : "user"
     * @return array ex : [ ["username" => "John", "password" => "ILovePHP"], ["username" => "Jane", "password" => "ILoveJava"] ]
     */

    public static function getAll(string $table) : array
    {
        $pdo = self::connect();
        $query = "SELECT * FROM $table";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $class = ucfirst($table);
        $result = $stmt->fetchAll(PDO::FETCH_CLASS, $class::class);
        return $result;
    }

    /**
     * Get an entity class from a table by primary key
     * @param string $table ex : "user"
     * @param string $primaryKey ex : "username"
     * @param string $valuePK ex : "John"
     * @return array ex : ["username" => "John", "password" => "ILovePHP"]
     */

    public static function getByPrimaryKey(string $table, string $primaryKey, string $valuePK) : array
    {
        $pdo = self::connect();
        $query = "SELECT * FROM $table WHERE $primaryKey = :valuePK";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':valuePK', $valuePK, PDO::PARAM_STR);
        $stmt->execute();
        $class = ucfirst($table);
        $result = $stmt->fetch(PDO::FETCH_CLASS, $class::class);
        return $result;
    }

    /**
     * Insert data into a table
     * @param string $table ex : "user"
     * @param array $dataFieldsTypes ex : [ ["field1", "type1"], ["username", "str"] ]
     * @param array $dataValues ex : ["value", "John"]
     * @return void
     */

    public static function insert(string $table, array $dataFieldsTypes, array $dataValues) : void
    {
        $pdo = self::connect();
        $fields = [];
        $values = [];
        foreach ($dataFieldsTypes as $key => $value) {
            $fields[] = $value[0];
            $values[] = ":".$value[0];
        }
        $fields = implode(", ", $fields);
        $values = implode(", ", $values);
        $query = "INSERT INTO $table ($fields) VALUES ($values)";
        $stmt = $pdo->prepare($query);
        foreach ($dataFieldsTypes as $key => $value) {
            $stmt->bindParam(":".$value[0], $dataValues[$key], self::getPDOType($value[1]));
        }
        $stmt->execute();
    }

    /**
     * Update data in a table
     * @param string $table ex : "user"
     * @param array $dataFieldsTypes ex : [ ["field1", "type1"], ["username", "str"] ]
     * @param array $dataValues ex : ["value", "John"]
     * @param string $primaryKey ex : "username"
     * @param string $valuePK ex : "John"
     * @return void
     */

    public static function update(string $table, array $dataFieldsTypes, array $dataValues, string $primaryKey, string $valuePK) : void
    {
        $pdo = self::connect();
        $fields = [];
        foreach ($dataFieldsTypes as $key => $value) {
            $fields[] = $value[0]." = :".$key;
        }
        $fields = implode(", ", $fields);
        $query = "UPDATE $table SET $fields WHERE $primaryKey = :valuePK";
        $stmt = $pdo->prepare($query);
        foreach ($dataFieldsTypes as $key => $value) {
            $stmt->bindParam(":".$key, $dataValues[$key], self::getPDOType($value[1]));
        }
        $stmt->bindParam(':valuePK', $valuePK, PDO::PARAM_STR);
        $stmt->execute();
    }

    /**
     * Delete data from a table
     * @param string $table ex : "user"
     * @param string $primaryKey ex : "username"
     * @param string $valuePK ex : "John"
     * @return void
     */

    public static function delete(string $table, string $primaryKey, string $valuePK) : void
    {
        $pdo = self::connect();
        $query = "DELETE FROM $table WHERE $primaryKey = :valuePK";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':valuePK', $valuePK, PDO::PARAM_STR);
        $stmt->execute();
    }

}