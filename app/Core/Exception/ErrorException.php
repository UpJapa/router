<?php 
namespace App\Core\Exception;

use App\Core\Http\Response;
use App\Model\Tpl;

class ErrorException{

    public static function sendError()
    {
        require_once(__DIR__ . "/../../../view/Exception.php");exit;
    }
    public static function notfound()
    {
        $templete = new Tpl();
        $templete->setTpl("frontend/404",[
            "one"   =>  4,
            "two"   =>  0,
            "tree"  =>  4,
            "Server"   =>  $_SERVER
        ]);
    }
}