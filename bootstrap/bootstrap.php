<?php

use App\Env\Variebles;

try {
    require_once __DIR__ . '/../vendor/autoload.php';

    ## carrega as variaveis de ambientes
    new Variebles();

} catch (\Throwable $th) {

    ## mensagem de erro
    echo $th->getMessage();
}

