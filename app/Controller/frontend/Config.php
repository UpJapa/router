<?php

namespace App\Controller\frontend;

use App\Core\Http\Request;
use App\Model\Config\Config as ControllerConfig;
use App\Model\View\Tpl;
use App\Model\Config\DataBase;

class Config{


    /**
     * MÉTODO RESPOSÁVEL POR RENDERIZAR PAGINA DE CONFIGURAÇÃO AO BANCO
     *
     * @param Request $request
     * @param array $args
     */
    public function getDbConfig(Request $request, $args){
        $template = new Tpl("config/",
        [
            "header" => false,
            "footer" => false
        ]);
        $template->setTpl("config/database");
    }

    /**
     * MÉTODO RESPOSÁVEL POR CRIAR O BANCO 
     *
     * @param Request $request
     * @param array $args
     */
    public function setDbConfig(Request $request, $args)
    {
       $controllerDb = new ControllerConfig();
       $controllerDb->controllerDB($request->getPost());

       new DataBase();
       sleep(10);

       $url = md5("adminconfig");
       header("Location: /{$url}");

    }

    /**
     * MÉTODO RESPOSÁVEL POR RENDERIZAR PAGINA DE CONFIGURAÇÃO AO ADMIN
     *
     * @param Request $request
     * @param array $args
     */
    public function getAdminConfig(Request $request, $args){
        $template = new Tpl("config/",
        [
            "header" => false,
            "footer" => false
        ]);
        $template->setTpl("config/admin");
    }

    /**
     * MÉTODO RESPOSÁVEL POR CRIAR O USUARIO ADMINISTRATIVO 
     *
     * @param Request $request
     * @param array $args
     */
    public function setAdminConfig(Request $request, $args)
    {

       $insertUser = new ControllerConfig();
       $insertUser->controllerADM($request->getPost());

       $url = md5("success");
       header("Location: /{$url}");
       
    }

    /**
     * Desenha na tela pagina de sucesso
     */
    public function success()
    {
        $template = new Tpl("config/",
        [
            "header" => false,
            "footer" => false
        ]);
        $template->setTpl("config/success");
    }

}
