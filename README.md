----------------------------History----------------------------
Commit n°1 : added expected visual, the database schema and the database code if you want to try the game at home on your computer (make sure you don't have a database already named "game_dev" or change the database name in the file to whatever you want)
Commit n°2 : added config.php for the connexion to the database (make sure to have the same "DBNAME" if you have changed the name of your database and put the right "DBUSER" and "DBPWD" if you use a different username and password)
Commit n°3 : added database connexion and primary functions to use
Commit n°4 : added class that represent each entity of the database
Commit n°5 : updated EntityRepository.php to have a singleton of $pdo to have less request on the database
