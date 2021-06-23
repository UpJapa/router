<?php

namespace App\Model\Config;

use App\Core\Db\Database\Database as ControllerDatabase;

class DataBase
{
    private $db,$queryTables;

    /**
     * quando é instanciada é criado as tabelas no banco de dados
     */
    public function __construct()
    {
        $this->db = new ControllerDatabase();
        $this->queryTables = __DIR__ . "/../../Core/Db/Model/sql/tables.sql";
        $this->setTable();
    }

    /**
     * executa a query
     *
     */
    public function setTable()
    {
        $this->db->select($this->getQuery());
    }

    /**
     * retorna query
     *
     * @return string
     */
    private function getQuery()
    {
        if($this->is_file())
        {
            return file_get_contents($this->queryTables);
        }
        else{
            throw new \Exception("Erro, query não constrada", 120);
        }
    }

    /**
     * verifica se query existe
     *
     * @return boolean
     */
    private function is_file()
    {
        return file_exists($this->queryTables);
    }

    /**
     * destroi variavel de conexão
     * e query
     */
    public function __destruct()
    {
        unset($this->db,$queryTables);
    }
}