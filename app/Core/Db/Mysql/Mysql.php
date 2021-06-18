<?php

namespace App\Core\Db\mysql;

use App\Core\Exception\ErrorException;
use App\Core\Log\Log;
use PDO;

class Mysql extends PDO{

    /**
     * @var object
     * variavel de conexão com mysql
     */
    private $conn;

    /**
     * método responsável por criar conexão com banco de dados
     */
    public function __construct()
    {
    
        $host = getenv("HOST_MYSQL");
        $dbname = getenv("DBNAME_MYSQL");
        $user = getenv("USER_MYSQL");
        $pass = getenv("PASS_MYSQL");
        $dns = "mysql:host=$host;dbname=$dbname;";
        
        try {
            $this->conn = new PDO($dns, $user, $pass, array('charset'=>'utf8'));
            $this->conn->query("SET CHARACTER SET utf8");
        } catch (\PDOException $pdo) {
            new Log("HttpException", $pdo->getMessage(), $pdo->getCode(), $pdo->getFile());
            ErrorException::sendError();
        }
        
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


}