<?php

use App\Http\Router;


$app = new Router();
$app->get("/", App\Controller\Home::class . ":getControlle");

$app->get("/sobre/{nome}", [function($nome, $request){
    var_dump($request);
}]);
$app->run();