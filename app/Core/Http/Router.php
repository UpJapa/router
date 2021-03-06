<?php

namespace App\Core\Http;

use App\Core\Exception\ErrorException;
use App\Core\Http\Exception\HttpException;
use App\Core\Http\RouterController;
use ReflectionFunction;


class Router extends RouterController{

    /**
     *  MÉTODO RESPONSÁVEL POR MANDAR OS PARAMENTOS PARA O CONTROLADOR
     * 
     */
    private function addRouter($method, $route, $paramets)
    {
        $this->controller($method, $route,$paramets);
    }

    /**
     * MÉTODO PESPONSÁVEL POR PEGAR ROTA E CALLBACK
     * ROTAS GET
     */
    public function get($route, $paramets)
    {
        $this->addRouter("GET", $route, $paramets);
    }
    /**
     * MÉTODO PESPONSÁVEL POR PEGAR ROTA E CALLBACK
     * ROTAS POSTS
     *
     * @param string $route
     * @param $paramets
     */
    public function post($route, $paramets)
    {
        $this->addRouter("POST", $route, $paramets);
    }


    /**
     * MÉTODO RESPONSÁVEL POR EXECUTAR A ROTA
     */
    public function run()
    {

        try {
            $exec = $this->buildRouter();
            // CHECA SE CONTROLLER É UMA FUNÇÃO ANONIMA OU UMA MÉTODO
            if($exec["controller"] instanceof \Closure){
                return $this->funcCall($exec);
            }else if(!empty($exec["controller"])){
                return $this->objectCall($exec);
            }
        } catch (HttpException $th) {
            return new Response($th->getCode(), ErrorException::sendError());
        }
        
        
        
    }

    /**
     * @return Method
     * Executa um methodo de uma class
     */
    
    private function objectCall($callable)
    {
        
        $class = $callable['controller'];
        $method = $callable['function'] ?? '';
       
        return call_user_func_array(
            array((object)$class, (string) $method), [$callable["request"], $callable["variables"]]
        );

    }

    /**
     * Executa um callback
     * @return \Closure
     */
    private function funcCall($callable)
    {

        // ADICIONA REQUEST NA VARIAVEL
        $callable["variables"]["request"] = $callable["request"];
        // REMOVE REQUEST
        unset($callable["request"]);

        $args = [];
        $buildParamets = new ReflectionFunction($callable['controller']);
        foreach ($buildParamets->getParameters() as $paramet) {
            $name  = $paramet->getName();
            $args[] = $callable["variables"][$name];
        }
        
        return call_user_func_array($callable["controller"], $args);

    }
}