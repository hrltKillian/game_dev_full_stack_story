<?php

require_once "EntityRepository.php";
require_once "../src/entity/Concept.php";

class ConceptRepository extends EntityRepository
{
    public function __construct()
    {
        parent::__construct("concept", "user_username");
    }
}