<?php

session_start();

class App
{
    public $URL;
    public $controller = 'Home';
    public $method = 'getAll';
    public $params = [];

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

        if (empty($this->URL) || !file_exists('../src/controller/' . ucfirst($this->URL[0]) . 'Controller.php')) {
            $this->URL = [];
            $this->URL[0] = 'home';
            header('location: /home');
        }
        return $this->URL;
    }

    /**
     * Get the parameters from the URL
     * @return array
     */

    private function getParams() : array
    {
        $this->params = $this->URL;
        unset($this->params[0]);
        $this->params = array_values($this->params);
        return $this->params;
    }

    /**
     * Get the controller from the URL
     * @return void
     */

    public function getController() : void
    {
        // Récuperer le controller associé à l'URL
        $this->URL = $this->getURL();
        $this->params = $this->getParams();
        if (!empty($this->params)) {
            $view = $this->URL[0] . $this->params[0];
        } else {
            $view = $this->URL[0];
        }
        $controller = ucfirst($this->URL[0]) . 'Controller.php';

        // Si le controller existe, instancier le controller
        if (file_exists('../src/controller/' . $controller)) {
            require_once '../src/controller/' . $controller;
            $this->controller = new (ucfirst($this->URL[0]) . 'Controller');

            // Si la méthode dans les paramètres existe, garder la méthode, sinon garder la méthode par défaut
            if (!empty($this->params[1] || in_array($this->params[1], $this->controller->ALLOWED_METHODS))){
                $this->method = $this->params[1];
            } else {
                $this->method = 'getAll';
            }

            // Si la clef primaire est "NotFound" (propre au controller NotFound) alors afficher la vue NotFound
            if ($this->controller->getEntityRepository()->getPrimaryKey1() == 'notFound') {
                $this->controller->getView($view, $this->controller->getAll());
                return;
            }
            // Afficher la vue associée au controller
            $this->controller->getView($view, $this->controller->{$this->method}());
            
        } else {
            // Rediriger vers l'URL notFound pour instancer le controller NotFound et afficher la vue NotFound
            header('location: /notFound');
        }
    }
}

if (isset($app)) {
    unset($app);
}

$app = new App($_SERVER['REQUEST_URI']);
$app->getController();
?>