<?php

namespace App\Model\View;

use App\Core\Image\ImageCompose;

class Images extends ImageCompose{

    /**
     * Classe espera uma imagem com o caminho completo
     *
     * @param string $file
     */
    public function __construct($file)
    {
        parent::__construct($file);
    }

    
}