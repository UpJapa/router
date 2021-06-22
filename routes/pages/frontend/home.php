<?php

use App\Core\Http\Response;


# 1 colocando namespace::class . ":namemetodo"
$app->get("/", App\Controller\frontend\Home::class . ":getControlle");

# 2 passando uma função anonima dentro de um array
$app->get("/sobre/{nome}", [function($nome, $request){
    return new Response(200, "Hello World ".PHP_EOL." by: {$nome}");
}]);