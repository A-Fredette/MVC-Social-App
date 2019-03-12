<?php
  /*
   * App Core Class
   * Creates URL & loads core controller
   * URL FORMAT - /controller/method/params
   */
  class Core {
    protected $currentController = 'Pages'; //Default controller page to be loaded (URL 1st param)
    protected $currentMethod = 'homepage'; //Default method of the controller to be called (URL 2nd param)
    protected $params = [];

    public function __construct() {
      $url = $this->getUrl();

      //Looks to see if url in Controllers directory
        if(file_exists('../app/controllers/'. ucwords($url[0]). '.php')) {
            //echo 'FILE EXISTS';
            //If yes, set as the controller value
            $this->currentController = ucwords($url[0]);
            //Unset 0 Index in URL array
            unset($url[0]);
        }

        //Require the controller
        require_once '../app/controllers/'. $this->currentController. '.php';

        //Instantiate
        $this->currentController = new $this->currentController;

        //Check for second part of URL
        if(isset($url[1])) {
            //Check to see if method exists in controller class
            if(method_exists($this->currentController, $url[1])) {
                $this->currentMethod = $url[1];
            }
            //unset
            unset($url[1]);
        }

        //Get params from URL (any values that aren't the controller or the method of the controller)
        $this->params = $url ? array_values($url) : [];

        //Call a callback with array of params
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);

    }

    public function getUrl(){
      if(isset($_GET['url'])) {
          $url = rtrim($_GET['url'], '/'); //trims a slash (if it exists) off of the URL
          $url = filter_var($url, FILTER_SANITIZE_URL); //PHP function to sanitize characters that should't in a URL
          $url = explode('/', $url); //PHP function that changes string to array, dividing on a '/'

          return $url;
      }
    }
  } 
  
  