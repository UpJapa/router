<?php

namespace App\Controller;

use App\Db\Mysql\Mysql;
use App\Http\Request;
use App\Http\Response;
use App\Tpl\View\Tpl;

class Home{

    public function getControlle(Request $request, $args = []){
        
        $tpl = new Tpl("frontend/home");
        
        $tpl->assign([
            "titulo" => "HOME | PAGE",
            "array"   => [
                "nome" => "vitor"
            ]
        ]); 

        return new Response(200, $tpl->init());
    }
}