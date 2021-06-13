<?php

namespace App\Controller;

use App\Db\Mysql\Mysql;
use App\Http\Request;
use App\Http\Response;
use App\Tpl\View\Tpl;

class Home{

    public function getControlle(Request $request, $args = []){
        
        $tpl = new Tpl("frontend/home");
        $sql = new Mysql();
        $results = $sql->select("SELECT * FROM tb_clients");
        $tpl->assign([
            "titulo" => "HOME | PAGE",
            "loop"  =>  $results
        ]); 

        return new Response(200, $tpl->init());
    }
}