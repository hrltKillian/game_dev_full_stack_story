<?php

require_once "../repository/EntityRepository.php";

class UserRepository extends EntityRepository
{
    public function __construct()
    {
        parent::__construct("users", "username");
    }
}