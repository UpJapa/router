<?php

namespace App\Core\Tpl\Cache;

abstract class CacheController{

    private $folder;
    private $fileCache;
    private $ext;


    /**
     * @param $folder PASTA 
     * @param $ext   TIPO DO ARQUIVO 
     */
    public function __construct($folder , $ext = "php")
    {
        $this->folder = $folder;
        $this->ext = $ext ?? "php";
    }

    protected function setFile($file)
    {
        $this->fileCache = sprintf("%s/%s%s.%s", $this->folder, $file , md5($file), $this->ext);
    }
    protected function getFile()
    {
        return $this->fileCache;
    }

    protected function verifyFile():bool
    {
        return file_exists($this->getFile());
    }

    protected function vefiryTimeFile():bool
    {
        return filemtime($this->getFile()) > time() - 2 ? true : false;
    }
}