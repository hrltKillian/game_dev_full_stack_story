----------------------------History----------------------------
Commit n°1 : added expected visual, the database schema and the database code if you want to try the game at home on your computer (make sure you don't have a database already named "game_dev" or change the database name in the file to whatever you want)
Commit n°2 : added config.php for the connexion to the database (make sure to have the same "DBNAME" if you have changed the name of your database and put the right "DBUSER" and "DBPWD" if you use a different username and password)
Commit n°3 : added database connexion and primary functions to use
Commit n°4 : added class that represent each entity of the database
Commit n°5 : updated EntityRepository.php to have a singleton of $pdo to have less request on the database
Commit n°6 : added a controller and primary functions to use
Commit n°7 : updated EntityRepository.php and Controller.php to have singletons to same memory and space
Commit n°8 : added repositories and controllers for each entity
Commit n°9 : added getView() in controller.php
Commit n°10 : rearranged templates. Started rooter in index.php. Created 404 repository, controller and view. Redirection to 404 page finished. 
Commit n°11 : finished rooter. updated getView to redirect to Notfound when the view is not found. Rearranged repository and entity requires.
Commit n°12 : added header and footer
Commit n°13 : added style on website. finished login form
Commit n°14 : finished signup form
Commit n°15 : managed errors for login when the username already exist or when the password is wrong
Commit n°16 : updated header with profil pic and added deconnexion
Commit n°17 : added register() in UserController to signup, managed errors for sign up and added createAllConcept() in ConceptController to create all defaults data for the game
