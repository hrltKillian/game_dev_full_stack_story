<?php

require_once "EntityRepository.php";

class NotFoundRepository extends EntityRepository
{
    public function __construct()
    {
        parent::__construct("user", "id");
    }
}