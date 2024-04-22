<?php

require_once 'Controller.php';
require_once '../src/controller/ConceptController.php';

class UserController extends Controller
{
    public function __construct()
    {
        parent::__construct("user", "username", "UserRepository");
    }

    private function getUsernames()
    {
        $users = $this->entityRepository->getAll();
        foreach ($users as $key => $value) {
            $usernames[] = $value->getUsername();
        }
        return $usernames;
    }

    public function login()
    {
        $username = $_POST['username'];
        $errors = [];
        if (empty($username)) {
            if (isset($_SESSION['errorGame'])) {
                $errors['errorGame'] = $_SESSION['errorGame'];
                unset($_SESSION['errorGame']);
            } else {
                $errors['errorUsername'] = "Username is empty";
            }
        } else if (empty($_POST['password'])) {
            $errors['errorPassword'] = "Password is empty";
        }
        $usernames = $this->getUsernames();
        if (!empty($errors)) {
            return $errors;
        }

        if (in_array($username, $usernames)) {
            $user = $this->entityRepository->getByPrimaryKey($username);
            if ($_POST['password'] == ($user[0]->getPassword())) {
                $_SESSION['username'] = $username;
                header('location: /home');
            } else {
                $errors['errorPassword'] = "Password incorrect";
            }
        } else {
            $errors['errorUsername'] = "Username not found";
        }
        return $errors;
    }

    public function deconnexion()
    {
        session_destroy();
        header('location: /home');
    }

    public function register()
    {
        $ConceptController = new ConceptController();
        $username = $_POST['username'];
        $errors = [];
        if (empty($username)) {
            $errors['errorUsername'] = "Username is empty";
        } else if (empty($_POST['password']) || empty($_POST['passwordConfirm'])) {
            $errors['errorPassword'] = "Password is empty";
        }
        $usernames = $this->getUsernames();
        if (in_array($username, $usernames)) {
            $errors['errorUsername'] = "Username already exists";
        } else {
            $password = $_POST['password'];
            $passwordConfirm = $_POST['passwordConfirm'];
            if ($password == $passwordConfirm) {
                $this->entityRepository->insert([["username", "str"],["password", "str"]], [$username, $password]);
                $_SESSION['username'] = $username;
                $ConceptController->createAllConcepts();
                header('location: /home');
            } else {
                $errors['errorPassword'] = "Passwords do not match";
            }
        }
        return $errors;
    }

    public function updateUsername()
    {
        $ConceptController = new ConceptController();
        $username = $_POST['newUsername'];
        $errors = [];
        if (empty($username)) {
            $errors['errorUsername'] = "Username is empty";
        } else if (empty($_POST['password']) || empty($_POST['passwordConfirm'])) {
            $errors['errorPassword'] = "Password is empty";
        }
        $usernames = $this->getUsernames();
        if (in_array($username, $usernames)) {
            $errors['errorUsername'] = "Username already exists";
        } else {
            $user = $this->entityRepository->getByPrimaryKey($_SESSION['username']);
            if ($_POST['password'] == ($user[0]->getPassword())) {
                $this->entityRepository->insert([["username", "str"],["password", "str"]], [$username, $user[0]->getPassword()]);
                $ConceptController->updateAllConceptsUsername($username);
                $this->entityRepository->delete($_SESSION['username']);
                $_SESSION['username'] = $username;
                header('location: /home');
            } else {
                $errors['errorPassword'] = "Password incorrect";
            }
        }
        return $errors;
    }
}
