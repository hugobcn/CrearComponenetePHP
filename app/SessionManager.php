<?php
namespace App;
use App\SessionFileDriver as Driver;
use App\SessionDriverInterface;

class SessionManager
{
    //protected static $loaded = false;
    //protected static $data = array();
    //protected  $loaded = false;    $this->load();
    protected  $data = array();      
    protected  $drive;
    
    public function __construct(SessionDriverInterface $drive) {
        $this->drive=$drive;
        
        $this->load();
    }
    
    //public static function load()
    public function load()
    {
        //if(static::$loaded) return;
        //if($this->$loaded) return;  $this->load();
        
        //static::$data = SessionFileDriver::load(); 
        $this->data = $this->drive->load(); //SessionFileDriver::load();
        
        // static::$loaded = true;
        //$this->$loaded = true;  $this->load();
    }
    
    //public static function get($key)
    public function get($key)
    {
        //static::load();
        //$this->load();
        
        
        
        //return isset(static::$data[$key]) ? static::$data[$key] : null;
        return isset($this->data[$key]) ? $this->data[$key] : null;
    }
}