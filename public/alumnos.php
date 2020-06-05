<?php

use \App\Container as Container;
//use App\Facades\Access;




require(__DIR__ . '/../bootstrap/start.php');

function alumnoController() {

    //global $access;
    $access = Container::getInstance()->access();
    //$access = Container::getInstance()->make('access');
    
    //if(!Access::check('student))  use App\Facades\Access; 
    if (!$access->check('alumno')) {
        abort404();
    }

    view('alumno', compact('access'));
}

alumnoController();
