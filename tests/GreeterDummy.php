<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Tests;

/**
 * Description of GreeterDummy
 *
 * @author hugoberpar
 */
class GreeterDummy{

    protected $name = 'Invitado';
    protected static $instance;
     
    //private function __construct($name = null)
   public function __construct($name = null)
    {

        if($name != null){
            $this->name = $name;
        }

    }
    
    public static function getInstance($name = null) {
        
        if(static::$instance == null){
            static::$instance = new GreeterDummy($name);
        }
         
       
        return static::$instance;
        //return  new GreeterDummy();
    }

    public function welcome()
    {
        return 'Bienvenido '.$this->name;
    }

}
