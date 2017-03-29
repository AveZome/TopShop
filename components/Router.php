<?php

/**
 * Class Router
 * Component for working with routes
 */
class Router
{
    /**
     * Property to collect the routes
     * @var array
     */
    private $routes;

    /**
     * Constructor
     */
    public function __construct()
    {
        $routesPath = ROOT . '/config/routes.php';
        $this->routes = include($routesPath);
    }

    /**
     * Returns request string
     */
    private function getURI()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    /**
     * Method for processing of request
     */
    public function run()
    {
        // Get the URI string
        $uri = $this->getURI();

        // Check for the existence of such a request in routes.php
        foreach ($this->routes as $uriPattern => $path) {

            // Compare $uriPattern and $uri
            if (preg_match("~$uriPattern~", $uri)) {

                // Get an internal path from an external path according to the rule.
                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);

                // Identify controller, action, parameters

                $segments = explode('/', $internalRoute);

                $controllerName = array_shift($segments) . 'Controller';
                $controllerName = ucfirst($controllerName);

                $actionName = 'action' . ucfirst(array_shift($segments));

                $parameters = $segments;

                // Connect file of controllers class
                $controllerFile = ROOT . '/controllers/' .
                    $controllerName . '.php';

                if (file_exists($controllerFile)) {
                    include_once($controllerFile);
                }

                // Create object, call method (action)
                $controllerObject = new $controllerName;


                $result = call_user_func_array(array($controllerObject, $actionName), $parameters);

                // if method of controller called successfully, then end router
                if ($result != null) {
                    break;
                }
            }
        }
    }

}