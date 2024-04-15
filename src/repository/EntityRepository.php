<?php

require_once "../../public/config.php";

abstract class EntityRepository
{
    private PDO $pdo;
    private string $table;
    private string $primaryKey;

    public function __construct(string $table, string $primaryKey)
    {
        $this->table = $table;
        $this->primaryKey = $primaryKey;
        $this->pdo = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME, DBUSER, DBPWD);
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
     * @return array ex : [ ["username" => "John", "password" => "ILovePHP"], ["username" => "Jane", "password" => "ILoveJava"] ]
     */

    public function getAll() : array
    {
        $query = "SELECT * FROM $this->table";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $class = ucfirst($this->table);
        $result = $stmt->fetchAll(PDO::FETCH_CLASS, $class::class);
        return $result;
    }

    /**
     * Get an entity class from a table by primary key
     * @param string $valuePK ex : "John"
     * @return array ex : ["username" => "John", "password" => "ILovePHP"]
     */

    public function getByPrimaryKey(string $valuePK) : array
    {
        $query = "SELECT * FROM $this->table WHERE $this->primaryKey = :valuePK";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':valuePK', $valuePK, PDO::PARAM_STR);
        $stmt->execute();
        $class = ucfirst($this->table);
        $result = $stmt->fetch(PDO::FETCH_CLASS, $class::class);
        return $result;
    }

    /**
     * Insert data into a table
     * @param array $dataFieldsTypes ex : [ ["field1", "type1"], ["username", "str"] ]
     * @param array $dataValues ex : ["value", "John"]
     * @return void
     */

    public function insert(array $dataFieldsTypes, array $dataValues) : void
    {
        $fields = [];
        $values = [];
        foreach ($dataFieldsTypes as $key => $value) {
            $fields[] = $value[0];
            $values[] = ":".$value[0];
        }
        $fields = implode(", ", $fields);
        $values = implode(", ", $values);
        $query = "INSERT INTO $this->table ($fields) VALUES ($values)";
        $stmt = $this->pdo->prepare($query);
        foreach ($dataFieldsTypes as $key => $value) {
            $stmt->bindParam(":".$value[0], $dataValues[$key], self::getPDOType($value[1]));
        }
        $stmt->execute();
    }

    /**
     * Update data in a table
     * @param array $dataFieldsTypes ex : [ ["field1", "type1"], ["username", "str"] ]
     * @param array $dataValues ex : ["value", "John"]
     * @param string $valuePK ex : "John"
     * @return void
     */

    public function update(array $dataFieldsTypes, array $dataValues, string $valuePK) : void
    {
        $fields = [];
        foreach ($dataFieldsTypes as $key => $value) {
            $fields[] = $value[0]." = :".$key;
        }
        $fields = implode(", ", $fields);
        $query = "UPDATE $this->table SET $fields WHERE $this->primaryKey = :valuePK";
        $stmt = $this->pdo->prepare($query);
        foreach ($dataFieldsTypes as $key => $value) {
            $stmt->bindParam(":".$key, $dataValues[$key], self::getPDOType($value[1]));
        }
        $stmt->bindParam(':valuePK', $valuePK, PDO::PARAM_STR);
        $stmt->execute();
    }

    /**
     * Delete data from a table
     * @param string $valuePK ex : "John"
     * @return void
     */

    public function delete(string $valuePK) : void
    {
        $query = "DELETE FROM $this->table WHERE $this->primaryKey = :valuePK";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':valuePK', $valuePK, PDO::PARAM_STR);
        $stmt->execute();
    }

}