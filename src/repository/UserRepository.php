<?php

require_once "EntityRepository.php";
require_once "../src/entity/User.php";

class UserRepository extends EntityRepository
{
    public function __construct()
    {
        parent::__construct("user", "username");
    }
}