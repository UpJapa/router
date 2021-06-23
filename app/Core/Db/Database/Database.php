<?php

namespace App\Core\Db\Database;

use Exception;
use PDO;
use PDOException;

class Database extends DatabaseController{

    /**
     * @var $conn
     * variavel de conexão com mysql
     */

    private $conn;

    /**
     * método responsável por criar conexão com banco de dados
     */
    public function __construct()
    {
        // verifica se json existe
        if ($this->verifyJson() !== true) {
           header("Location: /".md5('dbconfig')."");exit;
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
        try {
            $stmt->bindParam($key, $value);
        } catch (PDOException $th) {
            throw new Exception($th->getMessage(), 3001);
        }
        
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