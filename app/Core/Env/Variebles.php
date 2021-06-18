<?php

namespace App\Core\Env;

class Variebles{

    /**
     * @var string
     * aguarda o caminho do arquivo .env
     */
    private $env;

    /**
     * @var array
     * obtém todas variaveis 
     */
    private $variebles;

    /**
     * @param $env
     * espera o caminho completo do arquivo .env
     */
    public function __construct($env = __DIR__ . "/../../../../.env")
    {
        $this->env = $env;
        $this->setVariables();
    }

    /**
     * Método responsável por ler as variaveis mandar para o execute
     */
    private function setVariables()
    {
        $env = $this->controllerEnv();

        foreach ($env as $value) {
            // verifica se existe algum comentario
            if(preg_match_all("/^[#]/", $value)){
                continue;
            }
            $this->execute($value);
        }
        
    }

    /**
     * @param $value 
     * Método responsável por criar variavel de ambientes
     */
    public function execute($value)
    {
        // ADICIONA AS VARIAVES AO AMBIENTE
        putenv(trim($value));
    }

    /**
     * Método responsável por pegar os dados dentro do arquivo .env
     * @return string
     */
    private function getFileEnv()
    {
        return file_get_contents($this->env);
    }

    /**
     * méotodo responsável por separar as variaves 
     * @return array
     */
    private function controllerEnv()
    {
        if($this->is_file()){
            return explode(PHP_EOL, $this->getFileEnv());
        }else{
            throw new \Exception("Erro ao escrever o arquivo", 1221);
        }
        
    }

    /**
     * Verifica se o arquivo existe
     *
     * @return boolean
     */
    private function is_file():bool{
        return file_exists($this->env);
    }

}