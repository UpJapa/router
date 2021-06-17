<?php

use App\Core\Http\Router;
use App\Core\Tpl\View\Tpl;

/**
 * Variaveis globais HTML
*/

Tpl::setVars(["URL" => "app.locahost"]);

/**
 * @var array $paths
 * armazena todos arquivos de rotas
 */
$paths = [
    __DIR__ . '/pages/frontend/'   => "home.php",
    __DIR__ . '/api/v1/' =>    "frontend.php"
];

/**
 * @return 
 * adiciona os arquivos inserido no paths
*/

foreach ($paths as $key => $values) {
    require_once sprintf("%s%s", $key, $values);
}

// há dois modulo de chamada um callback
$app->run()->send();