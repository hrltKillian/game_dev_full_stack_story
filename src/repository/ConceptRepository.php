<?php

require_once "EntityRepository.php";

class ConceptRepository extends EntityRepository
{
    public function __construct()
    {
        parent::__construct("concept", "name");
    }
}