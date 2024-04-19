<?php

require_once 'Controller.php';

class ConceptController extends Controller
{
    public function __construct()
    {
        parent::__construct("concept", "name", "ConceptRepository");
    }

    public function createAllConcepts() 
    {
        $this->entityRepository->insert([["name", "str"], ["save_seed", "str"], ["user_username", "str"]], ["Concept", "1111111", $_SESSION['username']]);
        $this->entityRepository->insert([["name", "str"], ["save_seed", "str"], ["user_username", "str"]], ["Internet", "0111", $_SESSION['username']]);
        $this->entityRepository->insert([["name", "str"], ["save_seed", "str"], ["user_username", "str"]], ["Word", "11111", $_SESSION['username']]);
        $this->entityRepository->insert([["name", "str"], ["save_seed", "str"], ["user_username", "str"]], ["Site", "0000000", $_SESSION['username']]);
        $this->entityRepository->insert([["name", "str"], ["save_seed", "str"], ["user_username", "str"]], ["Brand", "000000000", $_SESSION['username']]);
        $this->entityRepository->insert([["name", "str"], ["save_seed", "str"], ["user_username", "str"]], ["Python", "0000000000", $_SESSION['username']]);
        $this->entityRepository->insert([["name", "str"], ["save_seed", "str"], ["user_username", "str"]], ["PHP", "0000000000", $_SESSION['username']]);
        $this->entityRepository->insert([["name", "str"], ["save_seed", "str"], ["user_username", "str"]], ["HTML/CSS", "00000", $_SESSION['username']]);
        $this->entityRepository->insert([["name", "str"], ["save_seed", "str"], ["user_username", "str"]], ["JavaScript", "0000000000", $_SESSION['username']]);
        $this->entityRepository->insert([["name", "str"], ["save_seed", "str"], ["user_username", "str"]], ["MySQL", "0000000", $_SESSION['username']]);
    }
}