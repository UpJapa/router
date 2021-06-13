<?php

namespace App\Tpl\View;

use App\Tpl\Cache\Cache;

class Tpl extends TplController{

    private $html;
    private $cache;
    

    /**
     * @param $fileHtml
     * @param $folder #se não passar, seu valor padrão é ./view 
     * $param $ext #se não passar, seu valor padrão é html 
     */
    public function __construct($fileHtml, $folder = __DIR__ . "/../../../view", $ext = "html")
    {

        parent::__construct($folder, $ext);
        $this->cache    = new Cache();
        $this->html     = $fileHtml ?? "";
        $this->setFile($fileHtml);
        $this->context = $this->getContext();
        
    }

    /**
     * @param $vars array variaveis do html
     * método responsável por criar as variaves no cache
     */
    public function assign($vars = [])
    {
        
        $this->vars = $vars;
        // CRIA AS VARIAVEIS
        $this->replaceVariables();
        // CRIA OS REPLACES DE ARRAYS
        $this->replaceArray();
        // CRIA O FOREACH PARA O LOOP
        $this->replaceLoop();
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