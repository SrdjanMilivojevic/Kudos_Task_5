<?php

class App
{
    /**
     * Controller / default Controller
     * @var string|object
     */
    private $controller = 'HomeController';
    /**
     * Action / default action
     * @var string
     */
    private $action = 'parse';
    /**
     * Parameters
     * @var array
     */
    private $params = [];
    /**
     *  This is the applications core. This code will
     *  run when we instantiate the application.
     */
    public function __construct()
    {
        // Get the url array
        $url = $this->parse_url();
        // First check if any uri segment is set.
        if (isset($url[0])) {
            $ifController = ucfirst($url[0]) . 'Controller';
            $controllerPath = ROOT . 'mvc/controllers/';
            // Is uri segment 1 controller ?
            if (file_exists($controllerPath . $ifController . '.php')) {
                $this->controller = $ifController;
                unset($url[0]);
                // If it is: Check if uri segment 2 is set. Is it an action ?
                if (isset($url[1]) && method_exists($this->controller, $url[1])) {
                    $this->action = $url[1];
                    unset($url[1]);
                }
                // If not: Is uri segment 1 an action ?
            } else if (!file_exists($controllerPath . $ifController . '.php') && method_exists($this->controller, $url[0])) {
                $this->action = $url[0];
                unset($url[0]);
            }
            // If non of these: parameters are in array.
            $this->params = $url ? array_values($url) : [];
        }
        // Include the controller.
        require_once ROOT . 'mvc/controllers/' . $this->controller . '.php';
        // Make new controller instance
        $this->controller = new $this->controller;
        // Call the method and forward params
        call_user_func_array([$this->controller, $this->action], $this->params);
    }
    /**
     * Split the GET url into array nods
     * @return array
     */
    private function parse_url()
    {
        if (isset($_GET['url'])) {
            return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }
}
