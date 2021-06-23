<?php 

namespace App\Core\Db\Database;

abstract class DatabaseController{

    /**
     * obtem variaveis de conexão com Database
     *
     * @var $varibles
     */
    private $varibles;

    /**
     * Verifica se json exisre com as variaveis com banco de dados
     *
     * @return bool
     */
    protected function verifyJson()
    {
        if (file_exists(__DIR__ . '/../config.json')) {
           $json = file_get_contents(__DIR__ . '/../config.json');
           $this->varibles = json_decode($json, true);
           return $this->buildVaribles();
        }
        return false;
    }

    protected function buildVaribles()
    {
        foreach ($this->varibles as $key => $value) {
            putenv(trim("{$key}={$value}"));
        }
        return true;
    }
}