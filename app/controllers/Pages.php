<?php

// All controller type files will extend the Controller class to give them access to
// it's methods that allow it to call views and models
class Pages extends Controller {

    public function __construct() {

    }

    public function homepage() {
        $this->view('homepage', ['title' => 'Welcome']);
    }

    public function about() {
        $this->view('about');
    }
}
