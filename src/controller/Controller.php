<?php

require_once "../repository/EntityRepository.php";

abstract class Controller
{
    private EntityRepository $entityRepository;

    /**
     * Constructor
     * @param string $table ex : "users"
     * @param string $primaryKey ex : "username"
     * @param string $repositoryClass ex : "UserRepository"
     * @return void
     */

    public function __construct(string $table, string $primaryKey, string $repositoryClass)
    {
        $this->entityRepository = new $repositoryClass($table, $primaryKey);
    }

    /**
     * Get all entities from a table
     * @return array ex : [ ["username" => "John", "password" => "ILovePHP"], ["username" => "Jane", "password" => "ILoveJava"] ]
     */

    public function getAll() : array
    {
        return $this->entityRepository->getAll();
    }

    /**
     * Get an entity class from a table by primary key
     * @param string $valuePK ex : "John"
     * @return array ex : ["username" => "John", "password" => "ILovePHP"]
     */

    public function getByPrimaryKey(string $valuePK) : array
    {
        return $this->entityRepository->getByPrimaryKey($valuePK);
    }

    /**
     * Insert data into a table
     * @param array $dataFieldsTypes ex : [ ["field1", "type1"], ["username", "str"] ]
     * @param array $dataValues ex : ["value", "John"]
     * @return void
     */

    public function insert(array $dataFieldsTypes, array $dataValues) : void
    {
        $this->entityRepository->insert($dataFieldsTypes, $dataValues);
    }

    /**
     * Update data in a table
     * @param array $dataFieldsTypes ex : [ ["field1", "type1"], ["username", "str"] ]
     * @param array $dataValues ex : ["value", "John"]
     * @param string $valuePK ex : "John"
     * @return void
     */

    public function update($dataFieldsTypes, array $dataValues, string $valuePK) : void
    {
        $this->entityRepository->update($dataFieldsTypes, $dataValues, $valuePK);
    }

    /**
     * Delete data from a table
     * @param string $valuePK ex : "John"
     * @return void
     */

    public function delete(string $valuePK) : void
    {
        $this->entityRepository->delete($valuePK);
    }

}