<?php

namespace App\Controller\frontend;

use App\Core\Db\Mysql\Mysql;
use App\Core\Http\Request;
use App\Model\Tpl;

class Home{

    public function getControlle(Request $request, $args){

        $db = new Mysql();
        $banners = [
            ["image" => "/view/images/frontend/mbuntu-11.jpg"],
            ["image" => "/view/images/frontend/mbuntu-13.jpg"],
            ["image" => "/view/images/frontend/mbuntu-14.png"]
        ];
      
        $template = new Tpl();
        $template->setTpl("frontend/home", 
        ["banners" => $banners]);
    }

}
