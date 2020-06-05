<?php

use App\Container;
use App\SessionArrayDriver;
use App\SessionManager;

require __DIR__ . '/../vendor/autoload.php';

//class_alias('App\AccessHandler','Access')  facade;
class_alias('App\Facades\Access','Access');

$container = Container::getInstance();

\App\Facades\Access::setContainer($container);

$container->singleton('access', function($app) {
return new AccessHandler($app->make(Authenticator::class));
});


$container->singleton('session', function(){
    $data = array(
        'user_data' => array(
            'name' => 'hugo',
            'role' => 'profesor'
        )       
    );
    
    $driver = new SessionArrayDriver($data);
    
    //return $this->shared['session'] = new SessionManager($driver);
    return new SessionManager($driver);
    
});


    $container->singleton('auth', function($container){
        return new App\Authenticator($container->make('session'));
    });
 
    $container->singleton('access',function($container){
       return new \App\AccessHandler($container->make('auth'));
    });
    
    

/*
$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();
 */

 

