<?php

require_once "EntityRepository.php";

class UserRepository extends EntityRepository
{
    public function __construct()
    {
        parent::__construct("user", "username");
    }
}