<?php

use App\Env\Variebles;

try {

    // CARREGA OS AUTOLOADS DAS CLASSES
    require_once __DIR__ . '/../vendor/autoload.php';

    ## carrega as variaveis de ambientes
    new Variebles();

} catch (\Throwable $th) {

    ## mensagem de erro
    echo $th->getMessage();
}

