<?php

use App\Core\Env\Variebles;
use App\Core\Exception\ErrorException;

try {
    // CARREGA OS AUTOLOADS DAS CLASSES
    require_once __DIR__ . '/../vendor/autoload.php';
    ## carrega as variaveis de ambientes
    new Variebles(__DIR__ . '/../.env');

} catch (\Throwable $th) {
    ## mensagem de erro
    ErrorException::sendError();
    echo $th->getCode();
}
