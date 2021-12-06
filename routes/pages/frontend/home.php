<?php

use App\Core\Http\Response;


# 1 colocando namespace::class . ":namemetodo
# colocando caminho completo como segundo paramentro da class e concatenando com dois pontos e virgula e nome da função
$app->get("/", App\Controller\frontend\Home::class . ":getControlle");

# 2 passando uma função anonima dentro de um array
# Passando uma function callback dentro de um array 
# chame o response caso precise redenrizar algo na tela, o conteúdo só é escrito na tela após chamar o send
$app->get("/sobre/{nome}", [function($nome, $request){
    $get = new Response(200, "Hello World ".PHP_EOL." by: {$nome}");
    $get->send();
}]);