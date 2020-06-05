<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Facades;

/**
 * Description of Facade
 *
 * @author hugoberpar
 */
use Exception;
use Styde\Container;

abstract class Facade
{

    protected static $container;

    public static function setContainer(Container $container)
    {
        static::$container = $container;
    }

    public static function getContainer()
    {
        return static::$container;
    }

    public static function getAccessor()
    {
        throw new Exception('Please define the getAccessor method in your facade');
    }

    public static function getInstance()
    {
        return static::getContainer()->make(static::getAccessor());
    }

    public static function __callStatic($method, $args)
    {
        $object = static::getInstance();
        switch (count($args)) {
            case 0:
                return $object->$method();
            case 1:
                return $object->$method($args[0]);
            case 2:
                return $object->$method($args[0], $args[1]);
            case 3:
                return $object->$method($args[0], $args[1], $args[2]);
            default:
                return call_user_func_array([$object, $method], $args);
        }
    }

}


