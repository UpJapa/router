<?php

namespace App\Model\Config;

class Config{

    private $config, $dbname, $user, $password, $posts, $jsonDb;
    public function controller($posts)
    {
        $this->host     = $posts["host"] ?? null;
        $this->dbname   = $posts["dbname"] ?? null;
        $this->user     = $posts["user"] ?? null;
        $this->password = $posts["password"] ?? null;
        $this->posts    = $posts["host"] ?? 3306;
        $this->createJsonDb();
    }
    private function createJsonDb()
    {
        $this->buildJson();
        $this->putJsonDb();
    }

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

    private function putJsonDb()
    {
        $fileJson = __DIR__ . '/../../Core/Db/config.json';
        if (!file_put_contents($fileJson, $this->jsonDb)) {
            throw new \Exception("Erro ao escrever o jsonDb", 1);
        }
    }
}