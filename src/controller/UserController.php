<?php

require_once 'Controller.php';

class UserController extends Controller
{
    public function __construct()
    {
        parent::__construct("user", "username", "UserRepository");
    }

    public function login()
    {
        $username = $_POST['username'];
        $users = $this->entityRepository->getAll();
        foreach ($users as $key => $value) {
            $usernames[] = $value->getUsername();
        }

        if (in_array($username, $usernames)) {
            $user = $this->entityRepository->getByPrimaryKey($username);
            if ($_POST['password'] == ($user[0]->getPassword())) {
                $_SESSION['username'] = $username;
                header('location: /game');
            } else {
                $errors['errorPassword'] = "Password incorrect";
            }
        } else {
            $errors['errorUsername'] = "Username not found";
        }
        return $errors;
    }
}
