<?php

namespace App\core\Http;

class Request{

    /**
     * @var
     * tem todos dados do cabeçalho
     */
    private $headers;

    /**
     * @var 
     * aguarda a URI
     */
    private $uri;

    /**
     * Pega os dados passado pela queryString 
     */
    private $queryString;

    /**
     * @var 
     * Pega todos os dados enviado via post
     */
    private $post;

    /**
     * @var 
     * Obtem o methodo atual
     */
    private $method;

    public function __construct()
    {
        $this->header = getallheaders();
        $this->queryString = $_GET ?? [];
        $this->post = $_POST ?? [];
        $this->uri = $_SERVER['REQUEST_URI'] ?? '';
        $this->method = $_SERVER['REQUEST_METHOD'] ?? '';
        
    }
    /**
     * Retorna os dados passado pela URL via $_GET 
     * 
     * @return array
     */
    public function getPost():array
    {
        return $this->post;
    }

    /**
     * Retorna 1 paramentro do post
     *
     * @param string $field
     * @return void
     */
    public function param(string $field)
    {
        return $this->post[$field];
    }

    /**
     * Retorna os dados enviado via post 
     * 
     * @return array
     */
    public function getQueryString():array
    {
        return $this->queryString;
    }

    /**
     * Retorna o URI 
     * 
     * @return array
     */
    public function getHeaders():array
    {
        return $this->header;
    }

    /**
     * Retorna o URI 
     * 
     * @return string
     */
    public function getURI():string
    {
        return  parse_url($this->uri, PHP_URL_PATH) ?? $_SERVER['REQUEST_URI'];
    }

    /**
     * Retorna o metódo 
     * GET, POST, PUT, DELETE
     * @return string
     */
    public function getMethod():string
    {
        return $this->method;
    }
}