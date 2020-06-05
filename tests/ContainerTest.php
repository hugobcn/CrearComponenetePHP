<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Tests;


use PHPUnit\Framework\TestCase as BaseTestcase;
use App\Container as cont;
use App\Container;
use App\ContainerException;



//use App\Foo as Foo;
/**
 * Description of ContainerTest
 *
 * @author hugoberpar
 */
class ContainerTest  extends BaseTestcase{
    
    public function test_bind_from_closure(){
        
        $container = new cont();
        
        //juntamos llave aun objeto
        $container->bind('key',function(){
            return 'Object';
            
        });
        
        
        //make instaciar este objeto
        $this->assertSame('Object',$container->make('key'));
        
    }
    
     public function test_bind_instance(){
       
        $container = new cont();
        
        $stdClass = new \stdClass();
        
        $container->instance('key',$stdClass);
        
        $this->assertSame($stdClass, $container->make('key'));
        
        
        
    }
   
    
    
    
    //nombre a un clase
    public function test_bind_from_class_name(){
        $container = new cont;
        
       //atar objeto a llave
        $container->bind('key','Tests\Foo');
        
       //var_dump($container->make('Foo'));
      
        //chequear instnacia objeto Foo
        $this->assertInstanceOf('Tests\Foo',$container->make('key'));
        //$this->assertInstanceOf('Foo',$container->make('Foo'));
        
    }
    
    public function test_bind_with_automatic_resolution()
    {
        $container = new Container();
         /*
        $container->bind('foo', 'Foo');

        $this->assertInstanceOf('Foo', $container->make('foo'));    
          */
        
        //atar objeto a llave
        $container->bind('key','Tests\Foo');
        
       //var_dump($container->make('Foo'));
      
        //chequear instnacia objeto Foo
        $this->assertInstanceOf('Tests\Foo',$container->make('key'));
        //$this->assertInstanceOf('Foo',$container->make('Foo'));
    }

    public function test_expected_container_exception_if_depency_does_not_exist(){
        
        $this->setExpectedException(
        ContainerException::class,
                'Unable to Build [Qux]: Class Norf does not exist'
                );
        
        
        $container = new cont();
        
        $container->bind('qux','Qux');
        
        $container-make('qux');
        
    }
    
    public function test_container_make_with_arguments()
    {
        $container = new cont();
        
        $this->assertInstanceOf(MailDummy::class,
                $container-> make('MailDummy',['url'=>'hugo.net','key'=>'secret'])
                );
    }
    
    
    public function test_singleton_instance(){
        
        $container = new Container();
        
        $container->singleton('foo','Tests\Foo');
        
        $this->assertSame(
                $container->make('foo')
               ,$container->make('foo')
                
                );
        
    }
    
}

class Foo {
/*
    public function __construct(Bar $bar)
    {
    }
 
 */

}

class MailDummy{
    
    private $url;
    private $key;
    
    public function __construct($url,$key) {
        $this->url =$url;
        $this->key =$key;
    }
}

class Bar {

    public function __construct(FooBar $fooBar)
    {
    }

}

