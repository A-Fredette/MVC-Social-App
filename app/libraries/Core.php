<?php

// Main App Core Class
// Creates URL
// Loads Core Controller
// URL Format: /{controller}/{method}/{param1}/{param2}

class Core {
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct() {
        //print_r($this->getUrl());

        $url = $this->getUrl();

        // Look in Controllers for Controller
        if (file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) { // ucwords capitalizes first letter if necessary
            // If the file exists, set as $currentController
            $this->currentController = ucwords($url[0]);

            // Unset (destroy) the zero index
            unset($url[0]);
        }

        // Require the Controller
        require_once '../app/controllers/' . $this->currentController . '.php';

        // Instantiate the Controller
        $this->currentController = new $this->currentController;

        // Get second part of a URL (methods)
        if(isset($url[1])) {
            if(method_exists($this->currentController, $url[1])) {
                $this->currentMethod = $url[1];
                echo '  Core Current Method: '.$this->currentMethod;
            }
            unset($url[1]);
        }

        // Get Method Params
        $this->params = $url ? array_values($url) : [];

        // A callback with an array of params, always returns the value of the callback
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }


    public function getUrl() {
        if(isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/'); // Trims '/' from the end of a string
            $url = filter_var($url, FILTER_SANITIZE_URL); // Removes all illegal URL chars from a string
            $url = explode('/', $url); // Breaks var into array, splitting on the '/'
            return $url;// Removes all illegal URL chars from a string
        }
    }

}