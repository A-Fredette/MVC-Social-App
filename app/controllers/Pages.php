<?php

class Pages {
    public function __construct() {
        echo 'Pages Controller loaded! ';
    }

//    // Since Pages is the default Controller we might need this to prevent a bug?
//    public function index() {
//
//    }

    public function about($id) {
        echo 'about method with id: '. $id;
    }
}