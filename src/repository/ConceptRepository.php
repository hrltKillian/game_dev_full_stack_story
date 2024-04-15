<?php

require_once "../repository/EntityRepository.php";

class ConceptRepository extends EntityRepository
{
    public function __construct()
    {
        parent::__construct("concept", "name");
    }
}