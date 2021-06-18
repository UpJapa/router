<?php

namespace App\Controller\frontend;

use App\Core\Http\Request;
use App\Core\Http\Response;
use App\Core\Tpl\View\Tpl;

class Home{

    public function getControlle(Request $request, $args){
        
        $tpl = new Tpl("frontend/home");
        
        $tpl->assign([
            "titulo" => "HOME | PAGE",
        ]); 
        return new Response(200, $tpl->init());
    }

}
