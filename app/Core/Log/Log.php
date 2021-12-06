<?php
namespace App\Core\Log;

use App\Core\Log\LogController;


/**
 * @throws Log
 * Classe de report
 */
class Log {
    protected $exception, $messege, $file ,$code, $folder, $line;

    /**
     * Método responsável gerar os logs
     *
     * @param string $exception
     * @param string $messege
     * @param string $code
     * @param string $file
     * @param string $line
     */
    public function __construct($exception, $messege, $code, $file, $line)
    {
        $this->exception = $exception ?? 'Erro no Exception';
        $this->messege = $messege ?? 'Erro no código';
        $this->code = $code ?? 500;
        $this->file = $file ?? __DIR__;
        $this->line = $line ?? '';
        $this->folder = __DIR__ . '/../../../log'; 
        $this->writeLog();
    }

    /**
     * MÉTODO RESPONSÁVEL POR ESCREVER O LOG
     *
     */
    private function writeLog()
    {
        $this->is_dir();
        $write = [
        '[' . $this->exception . ']' . PHP_EOL,
        "Dia: ". date('d-m-Y H:i:s') . PHP_EOL,
        "Mensagem: {$this->messege}" . PHP_EOL,
        "Arquivo: {$this->file} ". PHP_EOL,
        "Codigo: {$this->code} " . PHP_EOL,
        "Linha: {$this->line} " . PHP_EOL,
        "---------------------------------". PHP_EOL
        ];
        $fopen = fopen($this->getFile(), "a+");
        fwrite($fopen, implode("", $write));
        fclose($fopen);
        
    }

    /**
     * MÉTODO RESPONSÁVEL POR FORMARTA VARIAVEL COM NOME DO ARQUIVO
     * @return string
     */
    private function getFile()
    {
        return sprintf("%s/%s/%s.%s", $this->folder, date("Y-m") ,date("d-[l]"), "txt");
    }
   
    /**
     * MÉTODO RESPONSÁVEL POR RETORNAR NOME DO ARQUIVO 
     * @return string
     */
    private function getDir()
    {
        return sprintf("%s/%s", $this->folder, date("Y-m"));
    }

    /**
     * MÉTODO RESPONSÁVEL PRO CRIAR PASTA PRINCIPAL
     */
    private function is_dir()
    {
        if (!is_dir($this->getDir())){
            mkdir($this->getDir());
        } 
    }

    
}