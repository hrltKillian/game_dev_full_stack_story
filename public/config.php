<?php

if ($_SERVER['SERVER_NAME'] == 'localhost') {
    define ('DBNAME', "game_dev");
    define ('DBHOST', "localhost");
    define ('DBUSER', "root");
    define ('DBPWD', "");

    define ('ROOT', "http://localhost:8000");
} else {
    define ('DBNAME', "game_dev");
    define ('DBHOST', "localhost");
    define ('DBUSER', "root");
    define ('DBPWD', "");
    
    define ('ROOT', "https://www.mywebsite.com");
}
