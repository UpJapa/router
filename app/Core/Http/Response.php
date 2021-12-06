<?php

namespace App\Core\Http;

class Response{
    
    /**
     * obtém cabeçalho da pagina
     *
     * @var array
     */
    private $header;
     /**
     * pega o código passado pelo construct
     *
     * @var int
     */
    private $httpCode;

    /**
     * cria o header para pagina
     *
     * @var string
     */
    private $contentType;

    /**
     * retorna o conteúdo para view
     *
     * @var string
     */
    private $content;
    /**
     *  Método responsável por construir as varivaveis, e incia o tipo do cabeçalho
     * @param string $httpCode Código de resposta para o navegador
     * @param string $content Conteúdo que será escrito na tela
     * @param string $contentType Tipo de conteúdo Default "text/html"
     */
    public function __construct($httpCode = 200, $content, $contentType = "text/html")
    {
        $this->httpCode = $httpCode;
        $this->content = $content;
        $this->setHeader("Content-Type", $contentType);
    }

    /**
     * Método responsável por definir na classe o header 
     *
     * @param string $content
     * @param string $type
     */
    private function setHeader($content, $type)
    {
        $this->contentType = $type;
        $this->header[$content] = $type;    
    }

    /**
    * Método responsável por enviar o heades ao navegador 
    */
    private function setContentType()
    {
        http_response_code($this->httpCode);

        foreach ($this->header as $key => $value) {
            header($key . ": " . $value);
        }
    }

    /**
    * Método responsável por redenrizar o conteúdo
    */
    public function send()
    {

        $this->setContentType();

        switch($this->contentType)
        {
            case "text/html":
                echo $this->content;
                break;
            case "application/json":
                echo json_encode($this->content, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                break;
        }
    }
}