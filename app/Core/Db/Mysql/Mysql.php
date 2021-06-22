<?php

namespace App\Core\Db\Mysql;

use PDO;
use PDOException;

class Mysql extends PDO{

    /**
     * @var $conn
     * variavel de conexão com mysql
     */

    /**
     * obtem variaveis de conexão com mysql
     *
     * @var $varibles
     */
    private $conn, $varibles;

    /**
     * método responsável por criar conexão com banco de dados
     */
    public function __construct()
    {
        // verifica se json existe
        if ($this->verifyJson() !== true) {
           header("Location: /config");exit;
        }
        
        // pega as variaveis de ambientes
        $host = getenv("HOST_MYSQL");
        $dbname = getenv("DBNAME_MYSQL");
        $user = getenv("USER_MYSQL");
        $pass = getenv("PASS_MYSQL");

        // cria conexão
        $dns = "mysql:host=$host;dbname=$dbname;";
        // conecta com banco de dados
        $this->conn = new PDO($dns, $user, $pass, array('charset'=>'utf8'));
        $this->conn->query("SET CHARACTER SET utf8");
    }

    /**
     * @param $stmt
     * @param $paramets
     * método responsável por enviar os dados para o biendParam()
     */
    private function setParamets($stmt, $paramets)
    {
        foreach ($paramets as $key => $value) {
            $this->bindParam($stmt, $key, $value);
        }
    }

    /**
     * método responsável por executar bied no banco 
     * fazer o tratamento dos dados
     */
    private function bindParam($stmt, $key, $value)
    {
        $stmt->bindParam($key, $value);
    }

    /**
     * Método responsável por returnar query consultada no banco
     * @return array
     */
    public function select($query, $paramets = [])
    {
        $stmt = $this->conn->prepare($query);
        $this->setParamets($stmt, $paramets);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);   
    }

    /**
     * Verifica se json exisre com as variaveis com banco de dados
     *
     * @return bool
     */
    private function verifyJson()
    {
        if (file_exists(__DIR__ . '/../config.json')) {
           $json = file_get_contents(__DIR__ . '/../config.json');
           $this->varibles = json_decode($json, true);
           return $this->buildVaribles();
        }
        return false;
    }

    private function buildVaribles()
    {
        foreach ($this->varibles as $key => $value) {
            putenv(trim("{$key}={$value}"));
        }
        return true;
    }


}