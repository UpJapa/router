<?php

namespace App\Model\View;

use App\Core\Tpl\View\Tpl as ViewTpl;

class Tpl{

    private $tpl, $opts = ["header" => true, "footer" => true], $folderHTMl, $defaults = [];
    
    /**
     * CONSTROI AS VARIAVEIS PARA ENVIAR AO TPL CORE
     *
     * @param array $opts
     * @param string $dir
     * @param string $folderHTMl
     * @param string $ext
     */
    public function __construct(
        $folderHTMl = "frontend/",
        $opts = [],
        $dir =  __DIR__ . "/../../../view", 
        $ext = "html"
    ){

        $this->opts["data"]["session"] = $_SESSION;
        $this->defaults = array_merge($this->opts, $opts);
        $this->folderHTMl = $folderHTMl ?? 'frontend/';

        $config = array(
             "tpl_dir"  =>      $dir,
             "ext"      =>      $ext
        );

        ViewTpl::configure($config);

        $this->tpl = new ViewTpl();
        
        if($this->defaults["header"] === true) 
        $this->setTpl($this->folderHTMl . "header",["titulo" => "Home"]);
       
    }

    /**
     * MÉTODO RESPONSÁVEL POR DESENHAR O TPL OU RETORNAR UM TEMPLATE
     *
     * @param string $tplName
     * @param array $variebles
     * @return void
     */
    public function setTpl($tplName, $variebles = [])
    {
        $this->tpl->assign($tplName, $variebles);
        $this->tpl->draw();
    }
   
    /**
     * MÉTODO RESPONSÁVEL POR DESENHA O RODAPÉ 
     */
    public function __destruct()
    {
        if($this->defaults["footer"] === true) 
        $this->setTpl($this->folderHTMl . "footer");
    }

    
}