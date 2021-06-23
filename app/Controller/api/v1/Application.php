<?php 


namespace App\Controller\api\v1;

use App\Core\Http\Request;
use App\Core\Http\Response;


class Application{
    public function getData(Request $request, $args)
    {
        $json = [
            "version"  =>  "v1",
            "author"   =>  "vitor"
        ];
        $json ["insert"] = $request->getQueryString() ?? [];
        return new Response(200, $json, "application/json");
    }
}