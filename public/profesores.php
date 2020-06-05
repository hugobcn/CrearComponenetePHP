<?php

use \App\Container as Container;

require(__DIR__ . '/../bootstrap/start.php');



function profesorController() {

    //global $access;
    
    //$access = Container::getInstance()->make('access');
    $access = Container::getInstance()->access();

    if (!$access->check('profesor')) {
        abort404();
    }

    view('profesor', compact('access'));
}

profesorController();
