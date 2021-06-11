<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Controller\Home;
use App\Http\Router;


$app = new Router();
$app->get("/{nome}", Home::class . ":getControlle");
$app->get("/sobre", [function(){
    echo "sobre nós";
}]);

$app->run();