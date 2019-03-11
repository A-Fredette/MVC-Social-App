<?php

// All controller type files will extend the Controller class to give them access to
// it's methods that allow it to call views and models
class Pages extends Controller {

    public function __construct() {

    }

    public function index() {
        $this->view('hello');
    }

    public function about($id) {
        echo 'This is about method with param ' . $id;
    }
}
