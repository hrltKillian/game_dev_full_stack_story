<?php

require_once 'Controller.php';

class ConceptController extends Controller
{
    public function __construct()
    {
        parent::__construct("concept", "name", "ConceptRepository");
    }
}