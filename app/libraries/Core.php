<?php
  /*
   * App Core Class
   * Creates URL & loads core controller
   * URL FORMAT - /controller/method/params
   */
  class Core {
    protected $currentController = 'Pages'; //Default controller page to be loaded
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct(){
      $url = $this->getUrl();
        echo '../controllers/', ucwords($url[0]), '.php';

      //Looks to see if url in Controllers directory
        if(file_exists('../app/controllers/'. ucwords($url[0]). '.php')) {
            echo 'FILE EXISTS';
            //If yes, set as the controller value
            $this->currentController = ucwords($url[0]);
            //Unset 0 Index in URL array
            unset($url[0]);
        }

        //Require the controller
        require_once '../app/controllers/'. $this->currentController. '.php';

        //Instantiate
        $this->currentController = new $this->currentController;
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
  
  