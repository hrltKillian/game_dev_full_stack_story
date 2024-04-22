<?php

require_once 'Controller.php';

class GameController extends Controller
{
    public function __construct()
    {
        parent::__construct("concept", "name", "ConceptRepository");
    }

    public function playing() : array
    {
        if (!isset($_SESSION['username'])) {
            $_SESSION['errorGame'] = "You must be logged in to play";
            header('location: /user/login/login');
        }
        return $this->getByPrimaryKey($_SESSION['username']);
    }
}