<?php


namespace App\Facades;

class Access {
    
    protected static $container;
    
    public function check($roles){
        
        return Container::getInstance()->make('access')->check($roles);
    }
    
    public static function setContainer(Container $container){
        static::$container = $container;
    }
    
    
    public static function getContainer()
    {
        return static::$container;
    }
    
    
    public static function getAccesor() {
            return 'access';
        }
    

    
    public static function __callStatic($name, $arguments) {
        //$acccess = Container::getInstance()->make('access');
        $object= static::getContainer()->make(static::getAccesor());
        
       return call_user_func_array([$object,$method],$args);
    }
}


class Access extends Facade
{

    public static function getAccessor()
    {
        return 'access';
    }

}