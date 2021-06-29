<?php

namespace App\Controller\frontend;

use App\Core\Db\Database\Database;
use App\Core\Http\Request;
use App\Model\View\Images;
use App\Model\View\Tpl;

class Home{

    public function getControlle(Request $request, $args){

        new Database();
        
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
