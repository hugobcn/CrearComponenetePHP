<?php


namespace App;

use App\Authenticator as Auth;
use App\AuthenticatorInterface as AuthInter;


class AccessHandler
{
    /**
     *
     * @var App\Authenticator 
     */
    protected $auth;  
    
    /**
     * 
     * @param App\Authenticator Auth $auth
     */
    public function __construct(AuthInter $auth) {
        $this->auth = $auth;
    }

    //public static function check($role)
    // public function check($role)
    public function check($role)
    {
        //return 'admin' === $role;
        //return Auth::check() && Auth::user()->role === $role; (static)
        //var_dump($this->auth->user()->role);
        //die();
        /*
        if(!is_array($roles)){
            $roles = explode('|',$roles);
            }
         */
        return $this->auth->check() && $this->auth->user()->role === $role;
        //return $this->auth->check() && in_array($this->auth->user()->role,$roles);
        //return $this->auth->check() && $this->auth->user()->role === $role;
        
        
    }

}