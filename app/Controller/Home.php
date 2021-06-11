<?php

namespace App\Controller;

class Home{

    public function getControlle($args = []){
        echo "Classe Home {$args['nome']}";
    }
}