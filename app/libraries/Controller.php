<?php

    /*
     * Base Controller
     * Loads the Models and the Views
     *
     */

    class Controller {

        //Load Model
        public function model($model) {
            require_once '../app/models/' . $model . 'php';

            //Instantiate
            return new $model();
        }

        //Load View
        public function view($view, $data = []) {
            //Check for View File
            if(file_exists('../app/views/' . $view . '.php')) {
                require_once '../app/views/' . $view . '.php';
            } else {
                //Requested View doesn't exist
                die($view . 'View does not exist');
            }
        }

    }