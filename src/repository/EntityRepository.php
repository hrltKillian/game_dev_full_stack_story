<?php

require_once "../public/config.php";

abstract class EntityRepository
{
    protected PDO $pdo;
    protected string $table;
    protected string $primaryKey1;
    protected string $primaryKey2;
    protected string $class;

    public function __construct(string $table, string $primaryKey1, string $primaryKey2 = "")
    {
        $this->table = $table;
        $this->primaryKey1 = $primaryKey1;
        $this->primaryKey2 = $primaryKey2;
        $this->class = ucfirst($table);
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
        $result = $stmt->fetchAll(PDO::FETCH_CLASS, $this->class);
        return $result;
    }

    /**
     * Get an entity class from a table by primary key
     * @param string $valuePK ex : "John"
     * @return array ex : ["username" => "John", "password" => "ILovePHP"]
     */

    public function getByPrimaryKey(string $valuePK1, string $valuePK2 = "") : array
    {
        if ($valuePK2 == "") {
            $query = "SELECT * FROM $this->table WHERE $this->primaryKey1 = :valuePK1";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':valuePK1', $valuePK1);
        } else {
        $query = "SELECT * FROM $this->table WHERE $this->primaryKey1 = :valuePK1 AND $this->primaryKey2 = :valuePK2";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':valuePK1', $valuePK1);
        $stmt->bindParam(':valuePK2', $valuePK2);
        }
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_CLASS, $this->class);
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
     * @param string $valuePK1 ex : "Brand"
     * @param string $valuePK2 ex : "Jane"
     * @return void
     */

    public function update(array $dataFieldsTypes, array $dataValues, string $valuePK1, string $valuePK2 = "") : void
    {
        $fields = [];
        foreach ($dataFieldsTypes as $key => $value) {
            $fields[] = $value[0]." = :".$key;
        }
        $fields = implode(", ", $fields);

        if ($valuePK2 == "") {
            $query = "UPDATE $this->table SET $fields WHERE $this->primaryKey1 = :valuePK1";
            $stmt = $this->pdo->prepare($query);
            foreach ($dataFieldsTypes as $key => $value) {
                $stmt->bindParam(":".$key, $dataValues[$key], self::getPDOType($value[1]));
            }
            $stmt->bindParam(':valuePK1', $valuePK1, PDO::PARAM_STR);
        } else {
        $query = "UPDATE $this->table SET $fields WHERE $this->primaryKey1 = :valuePK1 AND $this->primaryKey2 = :valuePK2";
        $stmt = $this->pdo->prepare($query);
        foreach ($dataFieldsTypes as $key => $value) {
            $stmt->bindParam(":".$key, $dataValues[$key], self::getPDOType($value[1]));
        }
        $stmt->bindParam(':valuePK1', $valuePK1, PDO::PARAM_STR);
        $stmt->bindParam(':valuePK2', $valuePK2, PDO::PARAM_STR);
        }
        $stmt->execute();
    }

    /**
     * Delete data from a table
     * @param string $valuePK ex : "John"
     * @return void
     */

    public function delete(string $valuePK1, string $valuePK2 = "") : void
    {
        if ($valuePK2 == "") {
            $query = "DELETE FROM $this->table WHERE $this->primaryKey1 = :valuePK1";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':valuePK1', $valuePK1, PDO::PARAM_STR);
        } else {
        $query = "DELETE FROM $this->table WHERE $this->primaryKey1 = :valuePK1 AND $this->primaryKey2 = :valuePK2";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':valuePK1', $valuePK1, PDO::PARAM_STR);
        $stmt->bindParam(':valuePK2', $valuePK2, PDO::PARAM_STR);
        $stmt->execute();
        }
        $stmt->execute();
    }


    public function getPrimaryKey1()
    {
        return $this->primaryKey1;
    }

    public function getPrimaryKey2()
    {
        return $this->primaryKey2;
    }

    public function getTable()
    {
        return $this->table;
    }
}