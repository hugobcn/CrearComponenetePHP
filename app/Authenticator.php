<?php
    

namespace App;

use App\SessionManager as Session;

class Authenticator implements AuthenticatorInterface
{
    //protected static $user;
    protected  $user;
    
   /**
    * @var \App\SessionManager
    */
    protected  $session;
    
    
    /**
    * @param \App\SessionManager $session
    */
    public function __construct(Session $session) {
      
        $this->session = $session;
    }
    
    
    //public  static function check()
    public function check()
    {
        //return static::user() != null;
      
        return $this->user() != null;
        
    }
    
    
    //public static function user()
    public function user()
    {
        /*
        if(static::$user != null){
            return static::$user;
        }
        */
        
        if($this->user != null){
            return $this->user;
            //var_dump($data);
        }
        
        $data = $this->session->get('user_data');
        
        
        
        if(is_null($data)){
            //return static::$user = new User($data);
            //echo 'hay algo';
            //die();
            return null;
            
        }
        
        //var_dump($this->user = new User($data));
        //die();
        return $this->user = new User($data);
        
    }
    
}

