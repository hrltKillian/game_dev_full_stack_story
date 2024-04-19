<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Game Dev</title>
</head>

<body>
    <main class="d-flex justify-content-center">
        <div class="card text-center m-5 w-50">
            <div class="card-header d-flex justify-content-center align-items-center">
                <nav class="navbar navbar-expand-lg bg-body-tertiary">
                    <div class="container-fluid">
                        <?php if (isset($_SESSION['username'])) {
                            echo "<p class='mt-3'>" . $_SESSION['username'] . "</p>";
                        } ?>
                        <div class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/9/99/Sample_User_Icon.png" alt="Logo" width="30" height="30" class="d-inline-block align-text-top">
                            </a>
                            <ul class="dropdown-menu">
                                <?php if (!isset($_SESSION['username'])) {
                                    echo "<li><a class='dropdown-item' href='/user/login'>Login</a></li>";
                                    echo "<li><a class='dropdown-item' href='/user/signup'>Sign Up</a></li>";
                                } ?>
                                <li><a class="dropdown-item" href="/user/deconnexion">Deconnexion</a></li>
                            </ul>
                        </div>
                        <div class="collapse navbar-collapse" id="navbarNavDropdown">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link active" href="/home">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/game">Game</a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </nav>
            </div>