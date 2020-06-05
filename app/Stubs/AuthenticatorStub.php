<?php

namespace App\Stubs;

use App\User;
use App\AuthenticatorInterface;


class AuthenticatorStub implements AuthenticatorInterface 
{
    
   private $logged;
   
   public function __construct($logged = true) {
       $this->logged = $logged;
   }
    
    
    public function check(){ 
        return $this->logged;
    }
    
    
    public function user(){
        
        return  new User([
            'role' => 'admin'
        ]);
        
    }
}
