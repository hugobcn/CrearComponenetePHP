<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;

/**
 * Description of Container
 *
 * @author hugoberpar
 */
use Closure;

use Tests\Foo as foo;
use ReflectionClass;
use PHPUnit\Framework\InvalidArgumentException;


class Container {
    
    protected static $instance;
    
    protected $bindings =[];
    
    protected $shared =[];
    
    public static function getInstance()
    {
        if(static::$instance == null){
            static::$instance = new Container;
        }
        
        return static::$instance;
    }
    
    public static function setInstance(Container $container)
    {
        static::$instance =$container;
    }
    
    public function bind($name,$resolver,$shared =false){
        
        $this->bindings[$name] = [
             'resolver' => $resolver,
            'shared'=> $shared
        ];
    }
    
    public function make($name, array $arguments = array()){
        
        if(isset($this->shared[$name])){
            return $this->shared[$name];
        }
        
        //if(isset($this->bindings[$name]['resolver'])){
        if(isset($this->bindings[$name])){
            $resolver = $this->bindings[$name]['resolver'];
            $shared = $this->bindings[$name]['shared'];
        }else{
            $resolve =$name;
            $shared = false;
        }
        
        
        //si es closure
        
        if($resolver instanceof Closure){
          $object = $resolver($this); 
         
        }else{
            $object = $this->build($resolver,$arguments);
           
        }
       
        
        if ($shared) {
            $this->shared[$name] =$object;
        }
        
        return $object;
    }
    
    
   public function build($name, array $arguments = array())
    {
        $reflection = new ReflectionClass($name);
       

        if(!$reflection->isInstantiable()) {
            throw new InvalidArgumentException("$name is not instantiable");
        }

        $constructor = $reflection->getConstructor(); //ReflectionMethod
        
        
        
        if(is_null($constructor)) {
            return new $name;
        }

        $constructorParameters = $constructor->getParameters(); //[ReflectionParameter]

        $dependencies = array();

        foreach ($constructorParameters as $constructorParameter) {
            
            $parameterName = $constructorParameter->getName();
            
            if(isset($arguments[$parameterName])){
                $dependencies [$parameterName]= $arguments[$parameterName];
                continue;
            }
            
            try {
                 $parameterClass = $constructorParameter->getClass();
            } catch (\ReflectionException $e) {
                throw new ContainerException("Unable to build [$name]".$e->getMessage(), null,$e);
            } 
            
            if($parameterClass != null){
               $parameterClassName =  $parameterClass->getName();
               $dependencies[] = $this->build($parameterClassName);
            }else{
                throw new ContainerException("Please provide of the parameter [$parameterName]");
            }
            
        }
         
        
        // new Foo($bar)
        return $reflection->newInstanceArgs($dependencies);
    }


    
    
    
    
    public function instance($name,$object){
        
        $this->shared[$name] = $object;
    }
    
    
    
    public function singleton($name,$resolver){
        
       $this->bind($name,$resolver,true);
    }
    
    /*
    public function auth(){
        
         if (isset($this->shared['auth'])) {
             return $this->shared['auth'];
        }

        return $this->shared['auth'] = new Authenticator($this->session());
    }
    
    public function session(){
        
        if (isset($this->shared['session'])) {
             return $this->shared['session'];
        }
        
        
        $data = array(
            'user_data' => array(
                'user' => 'hugo',
                'role' => 'profesor'
            )
        );

        $driver = new SessionArrayDriver($data);
        return $this->shared['session'] = new SessionManager($driver);
    }
    
    
    public function access() {
        
        if (isset($this->shared['access'])) {
             return $this->shared['access'];
        }

        return $this->shared['access'] = new AccessHandler($this->auth());
    }
    */
}


