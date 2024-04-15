<?php

session_start();

class App
{
    public $URL;
    public $controller = 'Home';

    public function __construct($URL)
    {
        $this->URL = $_SERVER['REQUEST_URI'];
    }

    /**
     * Get the URL
     * @return array
     */

    private function getURL() : array
    {
        $this->URL = explode('/', $this->URL);
        $this->URL = array_filter($this->URL);
        $this->URL = array_values($this->URL);

        if (empty($this->URL) || count($this->URL) > 1) {
            $this->URL = [];
            $this->URL[0] = 'home';
        }
        return $this->URL;
    }

    /**
     * Get the controller from the URL
     * @return void
     */

    public function getController() : void
    {
        // Récuperer le controller associé à l'URL
        $this->URL = $this->getURL($this->URL);
        $controller = ucfirst($this->URL[0]) . 'Controller.php';

        // Si le controller existe, instancier le controller
        if (file_exists('../src/controller/' . $controller)) {
            require_once '../src/controller/' . $controller;
            $this->controller = new (ucfirst($this->URL[0]) . 'Controller');
            if ($this->controller->getEntityRepository()->getPrimaryKey() == 'id') {
                $this->controller->getView($this->URL[0]);
            }
            $this->controller->getView($this->URL[0], $this->controller->getAll());
        } else {
            require_once '../src/controller/NotFoundController.php';
            header('location: /notFound');
        }
    }
}

$app = new App($_SERVER['REQUEST_URI']);
$app->getController();
?>