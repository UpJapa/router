<?php

namespace App\Http;

use App\Controller\Home;
use App\Http\RouterController;
use ReflectionFunction;
use ReflectionObject;

class Router extends RouterController{

    private function addRouter($method, $route, $paramets)
    {
        $this->controller($method, $route,$paramets);
    }
    public function get($route, $paramets)
    {
        $this->addRouter("GET", $route, $paramets);
    }

    public function run()
    {
        $exec = $this->buildRouter();
    
        if(is_object($exec['controller'])){
             $this->objectCall($exec);
        }else{
             $this->funcCall($exec);
        }

        
        
    }

    private function objectCall($calleble)
    {
        
        $class = $calleble['controller'];
        $method = $calleble['function'] ?? '';
        
        return call_user_func_array(
            array((object)$class, (string) $method), [$calleble["variables"]]
        );
    }
    private function funcCall($calleble)
    {
        $args = [];
        $buildParamets = new ReflectionFunction($calleble['controller']);
        foreach ($buildParamets->getParameters() as $paramet) {
            $name  = $paramet->getName();
            $args[] = $calleble["variables"][$name];
        }
        return call_user_func_array($calleble["controller"], $args);
    }
}