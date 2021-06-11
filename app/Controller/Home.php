<?php

namespace App\Controller;
use App\Http\Request;
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

        echo $tpl->init();
    }
}