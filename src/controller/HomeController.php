<?php

require_once 'Controller.php';

class HomeController extends Controller
{
    public function __construct()
    {
        parent::__construct('user', 'home', 'NotFoundRepository');
    }
}