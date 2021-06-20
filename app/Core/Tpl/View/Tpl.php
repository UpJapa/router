<?php

namespace App\Core\Tpl\View;

use App\Core\Tpl\Cache\Cache;

class Tpl extends TplController{

    private $html;
    private $cache;
    private static $_glob = [];
    private static $config = [
        "folder" =>    __DIR__ . "/../../../../view",
        "ext"    =>    "html"
    ];

    /**
     * @param $fileHtml
     * @param $folder #se não passar, seu valor padrão é ./view 
     * $param $ext #se não passar, seu valor padrão é html 
     */
    public function __construct()
    {
        $this->cache    = new Cache();
        parent::__construct(Tpl::$config["tpl_dir"], Tpl::$config["ext"]);
       
    }

    public static function configure($config)
    {
        Tpl::$config = $config;
    }

    /**
     * método responsável por desenha o html
     */
    public function draw( $html = true )
    {
        
        if($html){
            echo $this->init();
        }else{
            return $this->init();
        }
        
        
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
    public function assign($fileHtml, $vars = [])
    {
        
        $this->html     = $fileHtml ?? "";
        $this->setFile($fileHtml);
        $this->context = $this->getContext();
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
         // CRIA AS FUNÇÕES
         $this->replaceIf();
         // CRIA AS VARIAVEIS 
        $this->createVariebles(); 
        // ESCREVE AS VARIAVEIS
        $this->echoVariebles();
    }

    /**
     * Método responsável por ler ou escrever no arquivo de cache
     * @return string
     */
    public function init()
    {
        
        if($this->cache->isCache($this->html)){
            $this->cache->writeCache($this->context);
        }
        
        return $this->cache->read($this->vars);
    }

}