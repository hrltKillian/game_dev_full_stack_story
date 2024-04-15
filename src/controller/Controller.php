<?php

require_once "../repository/EntityRepository.php";

abstract class Controller
{
    private EntityRepository $entityRepository;
    private string $table;

    public function __construct(string $table)
    {
        $this->entityRepository = new EntityRepository();
        $this->table = $table;
    }

    /**
     * Get all entities from a table
     * @param string $table ex : "user"
     * @return array ex : [ ["username" => "John", "password" => "ILovePHP"], ["username" => "Jane", "password" => "ILoveJava"] ]
     */

    public function getAll() : array
    {
        return $this->entityRepository->getAll($this->table);
    }

    /**
     * Get an entity class from a table by primary key
     * @param string $table ex : "user"
     * @param string $primaryKey ex : "username"
     * @param string $valuePK ex : "John"
     * @return array ex : ["username" => "John", "password" => "ILovePHP"]
     */

    public function getByPrimaryKey(string $table, string $primaryKey, string $valuePK) : array
    {
        return $this->entityRepository->getByPrimaryKey($table, $primaryKey, $valuePK);
    }

    /**
     * Insert data into a table
     * @param string $table ex : "user"
     * @param array $dataFieldsTypes ex : [ ["field1", "type1"], ["username", "str"] ]
     * @param array $dataValues ex : ["value", "John"]
     * @return void
     */

    public function insert(string $table, array $dataFieldsTypes, array $dataValues) : void
    {
        $this->entityRepository->insert($this->table, $dataFieldsTypes, $dataValues);
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

    public function update(string $table, array $dataFieldsTypes, array $dataValues, string $primaryKey, string $valuePK) : void
    {
        $this->entityRepository->update($this->table, $dataFieldsTypes, $dataValues, $primaryKey, $valuePK);
    }

    /**
     * Delete data from a table
     * @param string $table ex : "user"
     * @param string $primaryKey ex : "username"
     * @param string $valuePK ex : "John"
     * @return void
     */

    public function delete(string $table, string $primaryKey, string $valuePK) : void
    {
        $this->entityRepository->delete($this->table, $primaryKey, $valuePK);
    }

}