<?php

namespace App\Controller;

use App\Core\Db\Mysql\Mysql;
use App\Core\Http\Request;
use App\Core\Http\Response;
use App\Core\Tpl\View\Tpl;

class Home{

    public function getControlle(Request $request, $args){
        
        $tpl = new Tpl("frontend/home");
        $sql = new Mysql();
        $results = $sql->select("SELECT * FROM tb_depoimentos");
        $tpl->assign([
            "titulo" => "HOME | PAGE",
            "loop"  =>  $results
        ]); 
        return new Response(200, $tpl->init());
    }

}
