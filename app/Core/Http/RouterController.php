<?php

namespace App\Core\Http;

use App\Core\Exception\ErrorException;
use App\Core\Http\Exception\HttpException;
use Closure;
use Exception;
use App\Core\Http\Request;
use App\Core\Log\Log;

abstract class RouterController{



    /**
     * @param
     * aguarda todoas as rotas e callback passado
     * 
     */
    private $router = [];

    /**
     * @param
     * objeto da class Request
     * 
     */
    private $request;

    public function __construct()
    {
        $this->request = new Request();
    }

    /**
     * @method
     * @param $method [GET][POST][PUT][DELETE]
     * @param $router rota para ser mapeada
     * @param @paramets callbacks funções anônimas
     */
    protected function controller(string $method, string $route,  $callable)
    {

      $paramets = [];
       
       if(gettype($callable) !== "string"){
            foreach($callable as $key => $value){
                // VERIFICA SE PARAMETS PASSADO É UM CALLBACK
                if($value instanceof Closure){
                    // CRIA O CONTROLLER E REMOVE CHAVE DINAMICA
                    $paramets['controller'] = $value;
                    unset($paramets[$key]);
                }

            }

            $this->constructRouter($method, $route, $paramets);

       }else{
           /**
            * cria um objeto
            */
           $paramets['controller'] = $this->buildClass((string) $callable);
           /**
            * retorna nome do methodo
            */
           $paramets['function'] = $this->buildMethod((string) $callable);
           $this->constructRouter($method, $route, $paramets);
       }
       
    }

    /**
     * Método responsável por criar rota para a validação
     */

    private function constructRouter($method , $route, $paramets)
    {
        $paramets['variables'] = [];

        // CRIA EXPRESSÃO REGULAR
        $patern = "/{(.*?)}/";

        // VERIFICA NA ROTA PASSADA TEM ALGUMA VARIAVEL //
        if(preg_match_all($patern, $route, $matches)){
        
            // substitui {variavel} para (.*?) //
            $route = preg_replace($patern, "(.+)", $route);
            
            // SE EXISTE UMA VARIAVEL, $matches OBTEM ELA NA POSIÇÃO 1
            $paramets['variables'] = $matches[1] ?? [];

        }

        // INVERTER AS BARRAS PARA \/ //
        $patternRouter = '/^'. str_replace('/', '\/', $route) . '$/';

        // ADICIONA ROTA, VARIAVEIS E CALLBACK NA CLASSE //
        $this->router[$patternRouter][$method] = $paramets;
    }


    /**
     * @method buildRouter() método responsável por verificar se rota atual e methodo existe
     * @return array | Callback retorna array com uma função
     */
     protected function buildRouter()
     {

        try {
            $uri = strlen($this->request->getURI()) > 2 ? rtrim($this->request->getURI(),'/') : $this->request->getURI();
            $method = $this->request->getMethod();
            
            foreach ($this->router as $patternRouter => $http) {
                
                /** verifica se nas rotas contém a rota atual */
                if(preg_match($patternRouter,  $uri , $match)){
    
                    // exclui primeira posição
                    unset($match[0]);

                    # VERIFICA SE NA VARIAVEL É PASSADO UMA BARRA
                    $separetorURL = explode("/", $match[1]);
                    
                    // SE FOR MAIOR QUE 1 GERA UM NOVA EXEPTION
                    if(count($separetorURL) > 1){
                        throw new HttpException("URL não encontrada", 1);
                    }
                    
                    
                    // checa se na metodo é o mesmo do $method
                    if(isset($http[$method])){

                        // pega apenas o nome das variaveis
                        $key = $http[$method]['variables'] ?? [];
                    
                        // mescla nome com o valor da variaveis
                        $http[$method]['variables'] = array_combine($key, $match);
                        //adiciona o request na class 
                        $http[$method]["request"] = $this->request;
                        // retorna callback
                        return $http[$method];
                    }
                    throw new HttpException("Método não encontrado", 405);
                }
            }

            throw new HttpException("URL não encontrada", 404);

        } catch (HttpException $http) {
            header("Location: /404");exit;
        }
        
        
     }


     /**
      * Método responsável por retornar uma instacia a class passada
      * @param $paramet
      * @return Class
      */
     private function buildClass(string $paramet)
     {
        $className = explode(':', $paramet);
        return new $className[0] ?? null;
     }

     /**
      * Método responsável por retornar o nome do metéodo passado por paramentro
      * @param $paramet
      * @return Method
      */
     public function buildMethod(string $paramet)
     {
        $method = explode(':', $paramet);
        return end($method);
     }
}