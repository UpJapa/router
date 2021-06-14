<?php 
namespace App\Core\Exception;

class ErrorException{

    public static function sendError()
    {
        require_once(__DIR__ . "/../../../view/Exception.php");exit;
    }
}