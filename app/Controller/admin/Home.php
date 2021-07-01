<?php

namespace App\Controller\admin;

use App\Model\Admin\UserAdmin;
use App\core\Http\Request;
use  App\Model\View\Tpl;

class Home{
    public function getHomeAdmin(Request $request, $args)
    {
        UserAdmin::User();
        $template = new Tpl("admin/");
        $template->setTpl("admin/home",[
            "subtitulo" => "Pagina Administrativa"
        ]);
    }
}