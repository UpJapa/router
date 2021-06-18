<?php

namespace App\Core\Log;

abstract class LogController{

    protected $exception, $messege, $file ,$code, $folder;

    public function __construct($exception, $messege, $code, $file)
    {
        $this->exception = $exception ?? 'Erro no Exception';
        $this->messege = $messege ?? 'Erro no código';
        $this->code = $code ?? 500;
        $this->file = $file ?? __DIR__;
        $this->folder = __DIR__ . '/../../../log';   
        $this->writeLog();
    }
    private function writeLog()
    {
     $this->is_dir();
     $fopen = fopen($this->getFile(), "a+");

     $write = [
       $this->exception . PHP_EOL,
       "Dia: ". date('d-m-Y H:i:s') . PHP_EOL,
       "Mensagem: {$this->messege}" . PHP_EOL,
       "Arquivo: {$this->file} ". PHP_EOL,
       "Codigo: {$this->code} " . PHP_EOL,
       "---------------------------------". PHP_EOL
    ];

    fwrite($fopen, implode("" , $write) );

    fclose($fopen);
    }
    private function getFile()
    {
        return sprintf("%s/%s/%s.%s", $this->folder, date("Y") ,date("m-d"), "txt");
    }
   
    private function getDir()
    {
        return sprintf("%s/%s", $this->folder, date("Y"));
    }
    private function is_dir()
    {
        if (!is_dir($this->getDir())){
            mkdir($this->getDir());
        } 
    }
}