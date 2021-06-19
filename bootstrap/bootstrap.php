<?php

use App\Core\Log\Log;
use App\Core\Env\Variebles;
use App\Core\Exception\ErrorException;
use App\Core\Http\Exception\HttpException;
use App\Core\Tpl\Cache\Exception\CacheException;

// CARREGA OS AUTOLOADS DAS CLASSES
require_once __DIR__ . '/../vendor/autoload.php';



try {

    ## carrega as variaveis de ambientes
    new Variebles(__DIR__ . '/../.env');
    require_once __DIR__ . "/../routes/routes.php";

} catch (\Exception $th) {
    ## mensagem de erro
    new Log('Exception', $th->getMessage(), $th->getCode(), $th->getFile(), $th->getLine());
    ErrorException::sendError();
} catch (CacheException $th) {
    ## mensagem de erro
    new Log('CacheException', $th->getMessage(), $th->getCode(), $th->getFile(), $th->getLine());
    ErrorException::sendError();
} catch (HttpException $th) {
    ## mensagem de erro
    new Log('HttpException', $th->getMessage(), $th->getCode(), $th->getFile(), $th->getLine());
    ErrorException::notfound();
} catch (\PDOException $th) {
    ## mensagem de erro
    new Log('PDOException', $th->getMessage(), $th->getCode(), $th->getFile(), $th->getLine());
    ErrorException::sendError();
}

