<?php

namespace App\Controller\admin;

use App\Model\Admin\UserAdmin;
use App\core\Http\Request;
use App\Core\Http\Response;
use  App\Model\View\Tpl;

class Login{

    public function getLoginAdmin(Request $request, $args)
    {
        $template = new Tpl("admin/",[
            "header"=>false,
            "footer"=>false
        ]);
        $template->setTpl("admin/login");
    }

    public function verifyLoginAdmin(Request $request, $args)
    {
        $login = $request->param("login");
        $password = $request->param("password");
        $user = new UserAdmin();

        // pega o resultado da pagina
        $return = $user->loginAdmin($login, $password);

        // retorna ao usuario final um json
        $responde = new Response(200, $return, "application/json");
        $responde->send();
        
    }
}