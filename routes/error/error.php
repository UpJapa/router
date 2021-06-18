<?php

use App\Core\Http\Response;
use App\Core\Http\Router;


# 1 colocando namespace::class . ":namemetodo"
$app->get("/404", [function($request){
    return new Response(200, "error");
}]);

