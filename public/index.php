<?php

use \App\Container as Container;

require(__DIR__ . '/../bootstrap/start.php');

function homeController()
{
    $access = Container::getInstance()->access();
    
    
    //view('index'); facade
    view('index', compact('access'));
}

//var_dump($access);
//die();

homeController();

