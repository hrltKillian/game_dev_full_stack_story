<?php

require_once 'Controller.php';

class NotFoundController extends Controller
{
    public function __construct()
    {
        parent::__construct('user', 'notFound', 'NotFoundRepository');
    }
}