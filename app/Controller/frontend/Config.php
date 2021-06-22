<?php

namespace App\Controller\frontend;

use App\Core\Db\Mysql\Mysql;
use App\Core\Http\Request;
use App\Model\Config\Config as ConfigConfig;
use App\Model\Tpl;

class Config{

    public function getDbConfig(Request $request, $args){
        $template = new Tpl("config/",
        [
            "header" => false,
            "footer" => false
        ]);
        $template->setTpl("config/db");
    }

    public function setDbConfig(Request $request, $args)
    {
       $controllerDb = new ConfigConfig();
       $controllerDb->controller($request->getPost());
       header("Location: /");exit;
    }

}
