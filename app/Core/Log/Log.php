<?php
namespace App\Core\Log;

use App\Core\Log\LogController;

class Log extends LogController{
    public function __construct($exception, $messege, $code, $file)
    {
       parent::__construct($exception, $messege, $code, $file); 
       var_dump($this->code);
    }
}