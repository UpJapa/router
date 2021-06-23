<?php

namespace App\Model\Config;

use App\Core\Db\Database\Database;


class Config{

    private $config, 
                $dbname, $user, $password, $posts, $jsonDb,
                    $email, $login, $passwordadmin,$name, $dashboard;
    /**
     * MÉTODO RESPONSÁVEL POR RECEBER OS DADOS DO BANCO
     *  PARA CRIAR O JSON
     * @param $posts
     */
    public function controllerDB($posts)
    {
        $this->host     = $posts["host"] ?? null;
        $this->dbname   = $posts["dbname"] ?? null;
        $this->user     = $posts["user"] ?? null;
        $this->password = $posts["password"] ?? null;
        $this->posts    = $posts["port"] ?? 3306;
        $this->createJsonDb();
    }

    /**
     * CONTROLA PAGINA 
     * ESSA PAGINA INICIAL É FEITA PARA CRIAR O USUARIO ADMINISTRADOR DEFAULT
     * @param array $posts
     */
    public function controllerADM($posts)
    {
        $this->name          = $posts["name"] ?? null;
        $this->email         = $posts["email"] ?? null;
        $this->dashboard     = $posts["dashboard"] ?? 'admin';
        $this->login         = $posts["login"] ?? null;
        $this->passwordadmin = password_hash($posts["passwordadmin"], PASSWORD_DEFAULT,  ['cost' => 12,]);
        $this->setUserAdmin();
        $this->creteRouterAdmin();
    }

    /**
     * MÉTODO QUE CHAMA FUNÇÃO PARA CRIAR O JSON
     * CHAMA FUNÇÃO PARA ESCREVER NO JSON
     *
     */
    private function createJsonDb()
    {
        $this->buildJson();
        $this->putJsonDb();
    }


    /**
     * CRIA AS VARIAVEIS
     *
     */
    private function buildJson()
    {
    $this->jsonDb = '{
    "DBNAME_MYSQL": "'.$this->dbname.'",
    "HOST_MYSQL":   "'.$this->host.'",
    "USER_MYSQL":   "'.$this->user.'",
    "PASS_MYSQL":   "'.$this->password.'",
    "PORT_MYSQL":   "'.$this->posts.'"
}';

    }

    /**
     * ESCREVE AS VARIAVEIS CRIADAS NO BUILDJSON()
     * NO JSON
     */
    private function putJsonDb()
    {
        $fileJson = __DIR__ . '/../../Core/Db/config.json';
        if (!file_put_contents($fileJson, $this->jsonDb)) {
            throw new \Exception("Erro ao escrever o jsonDb", 1);
        }
    }

    private function setUserAdmin()
    {

        $db = new Database();

        $db->select("INSERT INTO db_admin_usuarios (iduser,id_group,nome, login, senha, email, admin) VALUES (:iduser,:id_group,:nome,:login,:senha,:email, :admin)",[
            ":iduser"   =>  1,
            ":id_group" =>  1,
            ":nome"     =>  $this->name,
            ":email"    =>  $this->email,
            ":login"    =>  $this->login,
            ":senha"    =>  $this->passwordadmin,
            ":admin"    =>  "Y"
        ]);
        sleep(3);
        unset($db);
    }
    private function creteRouterAdmin()
    {
        if (file_exists(__DIR__ . "/../../../.env")) {
           $env = file_get_contents(__DIR__ . "/../../../.env");
           file_put_contents(__DIR__ . "/../../../.env", str_replace('ROUTER_DASHBOARD='.getenv('ROUTER_DASHBOARD').'', 'ROUTER_DASHBOARD='.$this->dashboard.'', $env));
        }
    }
    
}