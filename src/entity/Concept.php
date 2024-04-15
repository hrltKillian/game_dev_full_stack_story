<?php

require_once "../entity/User.php";

class Concept 
{
    private string $name;
    private string $save_seed;
    private User $user;

    public function getName() : string
    {
        return $this->name;
    }   

    public function setName(string $name) : void
    {
        $this->name = $name;
    }

    public function getSaveSeed() : string
    {
        return $this->save_seed;
    }

    public function setSaveSeed(string $save_seed) : void
    {
        $this->save_seed = $save_seed;
    }

    public function getUser() : User
    {
        return $this->user;
    }

    public function setUser(User $user) : void
    {
        $this->user = $user;
    }

}