<?php

namespace App\Core\Tpl\Cache;

use App\Core\Exception\ErrorException;
use App\Core\Log\Log;
use App\Core\Tpl\Cache\Exception\CacheException as ExceptionCacheException;


class Cache extends CacheController{

    /**
     * @param $fileHtml
     * @param $folder #caso não será passado, seu valor padrão é: ./view 
     * $param $ext #caso não será passado, seu valor padrão é: php 
     */
    public function __construct($folder =  __DIR__ . "/../../../../cache", $ext = "php")
    {
        parent::__construct($folder, $ext);
    }

    /**
     * @param $file
     * checa se $file (cache) existe e se está atualizado
     * se estiver atualizado seu retorno será falso se seu filemetime(tempo-que-foi-modificado-ou-criado) for maior que timestamp - 60s
     * se não existi ou se filemtime() não for maior que  timesatamp - 60s atual seu retorno será verdadeiro
     */
    public function isCache($file):bool
    {
        
        $this->setFile($file);

        if(!$this->verifyFile()){
            return true;
        }else if( !$this->vefiryTimeFile() ){
            return true;
        }

        return false;
    }

    /**
     * @param $context # espera o conteúdo para escrever em cache
    */
    public function writeCache($context)
    {
        try {
        
            if(!file_put_contents($this->getFile(), $context)){
                throw new ExceptionCacheException("Erro ao criar o arquivo: ". $this->getFile(), 1);
            }
        } catch (ExceptionCacheException $th) {
            new Log("ExceptionCacheException", $th->getMessage(), $th->getCode(), $th->getFile());
            ErrorException::sendError();
        }
       
    }

    /**
     * @param $variebles array #espera um array para extrair
     * @return require
     */
    public function read($variebles = [])
    {

         ob_start();

         // EXTRAI AS VARIAVEL
         extract($variebles);

         // pega o contéudo do arquivo cache
         require ($this->getFile());

         //@return o require
         return ob_get_clean();

    }
}