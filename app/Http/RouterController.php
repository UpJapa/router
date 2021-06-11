<?php

namespace App\Http;


use Closure;
use Exception;


abstract class RouterController{

    /**
     * @var 
     * OBTEM A URI ATUAL
     * (sem prefix)
     */
    private $uri;

    /**
     * @var
     * OBTEM O METODO REQUISITADO
     */
    private $method;

    /**
     * @param
     * aguarda todoas as rotas e callback passado
     * 
     */
    private $router = [];
    
    public function __construct()
    {

        $this->uri = $_SERVER['REQUEST_URI'];
        $this->method = $_SERVER['REQUEST_METHOD'];
        
    }

    /**
     * @method
     * @param $method [GET][POST][PUT][DELETE]
     * @param $router rota para ser mapeada
     * @param @paramets callbacks funções anônimas
     */
    protected function controller(string $method, string $route,  $calleble)
    {

      $paramets = [];
       if(!is_string($calleble)){
            foreach($calleble as $key => $value){
                // VERIFICA SE PARAMETS PASSADO É UM CALLBACK
                if($value instanceof Closure){

                    // CRIA O CONTROLLER E REMOVE CHAVE DINAMICA
                    $paramets['controller'] = $value;
                    unset($paramets[$key]);
                }

            }
       }else{
           /**
            * cria um objeto
            */
           $paramets['controller'] = $this->buildClass((string) $calleble);
           /**
            * retorna nome do methodo
            */
           $paramets['function'] = $this->buildMethod((string) $calleble);

       }
       

        $paramets['variables'] = [];

        // CRIA EXPRESSÃO REGULAR
        $patern = "/{(.*?)}/";

        // VERIFICA NA ROTA PASSADA TEM ALGUMA VARIAVEL
        if(preg_match_all($patern, $route, $matches)){

            // substitui {variavel} para (.*?)
            $route = preg_replace($patern, "(.*?)", $route);

            // SE EXISTE UMA VARIAVEL, $matches OBTEM ELA NA POSIÇÃO 1
            $paramets['variables'] = $matches[1] ?? [];
        }

        // INVERTER AS BARRAS PARA \/
        $patternRouter = '/^'. str_replace('/', '\/', $route) . '$/';

        // ADICIONA ROTA, VARIAVEIS E CALLBACK NA CLASSE
        $this->router[$patternRouter][$method] = $paramets;

    }

    /**
     * @method buildRouter() método responsável por verificar se rota atual e methodo existe
     * @return array | Callback retorna array com uma função
     */
     protected function buildRouter()
     {
        foreach ($this->router as $patternRouter => $http) {
            
            /** verifica se nas rotas contém a rota atual */
            if(preg_match($patternRouter, $this->uri, $match)){

                unset($match[0]);
                // checa se na metodo é o mesmo do $this->method
                if(isset($http[$this->method])){

                    // pega apenas o nome das variaveis
                    $key = $http[$this->method]['variables'] ?? [];
                   
                    // mescla nome com o valor da variaveis
                    $http[$this->method]['variables'] = array_combine($key, $match);
                    
                    // retorna callback
                    return $http[$this->method];
                }
                throw new Exception("Método não encontrado", 405);
            }
        }
        throw new Exception("URL não encontrada", 404);
        
     }

     private function buildClass(string $paramet)
     {
        $className = explode(':', $paramet);
        return new $className[0] ?? null;
     }
     public function buildMethod(string $paramet)
     {
        $method = explode(':', $paramet);
        return end($method);
     }
}