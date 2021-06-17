<?php

namespace App\Core\Tpl\View;

use App\Core\Tpl\Cache\Cache;

class Tpl extends TplController{

    private $html;
    private $cache;
    private static $_glob = [];

    /**
     * @param $fileHtml
     * @param $folder #se não passar, seu valor padrão é ./view 
     * $param $ext #se não passar, seu valor padrão é html 
     */
    public function __construct($fileHtml, $folder = __DIR__ . "/../../../../view", $ext = "html")
    {

        parent::__construct($folder, $ext);
        $this->cache    = new Cache();
        $this->html     = $fileHtml ?? "";
        $this->setFile($fileHtml);
        $this->context = $this->getContext();
        
    }

    /**
     *  Adiciona na class as variaveis
     *
     * @param array $vars
     */
    public static function setVars($vars)
    {
        self::$_glob = $vars;
    }

    /**
     * @param $vars array variaveis do html
     * método responsável por criar as variaves no cache
     */
    public function assign($vars = [])
    {
        
        $this->vars = $vars;

        // add $_glob no final
        $this->vars = array_merge($this->vars, self::$_glob);
        
        // CRIA AS VARIAVEIS
        $this->replaceVariables();
        // CRIA OS REPLACES DE ARRAYS
        $this->replaceArray();
        // CRIA O FOREACH PARA O LOOP
        $this->replaceLoop();
        // CRIA AS FUNÇÕES
        $this->replaceFunction();
    }

    /**
     * Método responsável por ler ou escrever no arquivo de cache
     * @return string
     */
    public function init()
    {
        if($this->cache->isCache(end(explode("/",$this->html)))){
            $this->cache->writeCache($this->context);
        }
        return $this->cache->read($this->vars);
    }

}