<?php

require_once 'Controller.php';

class GameController extends Controller
{
    public function __construct()
    {
        parent::__construct("user", "id", "UserRepository");
    }
}