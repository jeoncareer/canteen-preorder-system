<?php

// The App class is responsible for handling the main routing and controller loading logic of the application.
// It parses the URL, loads the appropriate controller and method, and passes any parameters.
class App
{
    // Default controller name
    private $controller = 'Home';
    // Default method name
    private $method = 'index';
    // Splits the URL into parts for routing
    private function splitURL()
    {
        // Get the 'url' parameter from the query string, or default to 'home'
        $URL = $_GET['url'] ?? 'home';
        $URL = explode("/", trim($URL, "/"));
        return $URL;
    }

    // Loads the appropriate controller and method based on the URL
    public function loadController()
    {
        $URL = $this->splitURL();
        /// SELECT CONTROLLER

        // Build the filename for the controller
        $filename = "../app/controllers/" . ucfirst($URL[0]) . ".php";
        if (file_exists($filename)) {
            require $filename;
            $this->controller = ucfirst($URL[0]);
            unset($URL[0]);
        } else {
            // If controller not found, load the 404 controller
            $filename = "../app/controllers/_404.php";
            if (file_exists($filename)) {
                require $filename;
                $this->controller = "_404";
            }
        }
        // Instantiate the controller
        $controller = new $this->controller();
        /// SELECT METHOD
        if (!empty($URL[1])) {
            if (method_exists($controller, $URL[1])) {
                $this->method = $URL[1];
                unset($URL[1]);
            }
        }

        // Call the selected method on the controller, passing any remaining URL parts as parameters
        call_user_func_array([$controller, $this->method], $URL);
    }
}
