<?php

    // Load Config
    require_once 'config/config.php';

    // Load Libraries
    //require_once 'libraries/Core.php';
    //require_once 'libraries/Controller.php';
    //require_once 'libraries/Database.php';

    //Load Libraries
    // Auto Loader --> will require all library files IF their names match class names defined in these files
    spl_autoload_register(function($className) {
        require_once 'libraries/' . $className . '.php';
    });

