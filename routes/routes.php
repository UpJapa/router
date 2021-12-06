<?php

use App\Core\Tpl\View\Tpl;

/**
 * Variaveis globais HTML
*/

Tpl::setVars(["URL" => getenv("URI_DEFAULT")]);

/**
 * @var constant constante que guarda a rota padrão da pagina administrativa
 */
define("ROUTER_DEFAULT", getenv("ROUTER_DASHBOARD"));

/**
 * @var array $paths
 * armazena todos arquivos de rotas
 */
$paths = [
    __DIR__ . '/pages/config/'   => "config.php",
    __DIR__ . '/pages/frontend/'   => "home.php",
    __DIR__ . '/pages/admin/' => "routers.php",
    __DIR__ . '/api/v1/' =>    "frontend.php" 
];
/**
 * @return 
 * adiciona os arquivos inserido no paths
*/
foreach ($paths as $key => $values) {
    require_once sprintf("%s%s", $key, $values);
}

# há dois modulo de chamada um callback
# veja no arquivo __DIR__ . "/routes/pages/frontend/home.php";
$app->run();

