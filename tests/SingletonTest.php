<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Tests;

/**
 * Description of SingletonTest
 *
 * @author hugoberpar
 */
use PHPUnit\Framework\TestCase as BaseTestCase;
use Tests\GreeterDummy;
use App\Container;


class SingletonTest extends BaseTestCase
{
   public function test_singleton_instance()
    {
       $firstCall = GreeterDummy::getInstance();
       
        $this->assertInstanceOf(
                GreeterDummy::class,
                GreeterDummy::getInstance()
                );
        
    }
    
    public function test_singleton_creates_only_one_instance(){
        
        $this->assertSame(
        GreeterDummy::getInstance(),
        GreeterDummy::getInstance()                       
                );
        
    }
    
    public function test_welcome_known_users()
    {
        //$greeter = GreeterDummy::getInstance('Invitado');
        $greeter = new GreeterDummy('hugo');
        
        $this->assertSame('Bienvenido hugo', $greeter->welcome());
        
    }
    
}
