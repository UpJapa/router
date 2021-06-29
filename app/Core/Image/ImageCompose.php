<?php

namespace App\Core\Image;

abstract class ImageCompose{

    /**
     * Variavel que armazena imagem criada pelo GD
     *
     * @var 
     */
    private $image;

    /**
     * Aguarda tipo da imagem
     *
     * @var string
     */
    private $type;

    /**
     * Guarda nome da imagem
     *
     * @var string
     */
    private $filename;
    /**
     * Constroi imagem com biblioteca GD
     *
     * @param string $file
     */
    public function __construct($file)
    {
        $this->image = imagecreatefromstring(file_get_contents($file));

        // pega toda informação da imagem
        $infoImage = pathinfo($file);

        // pega nome da imagem sem a extensão
        $this->filename = pathinfo($file, PATHINFO_FILENAME);
        // pega tipo da imagem
        $this->type = $infoImage['extension'] == "jpg" ? "jpeg" : $infoImage['extension'];

        // completa nome da imagem
        $this->filename .= ".{$this->type}";
        
    }

    /**
     * Redimensiona imagem
     *
     * @param integer $width largura
     * @param integer $height [opcional] altura
     */
    public function resize(int $width, int $height = -1)
    {
        $this->image = imagescale($this->image, $width, $height);
    }

    /**
     * Método responsável por salvar uma nova imagem
     *
     * @param string $pathSave caminho para ser salvo 
     * @param integer $quality qualidade para ser salvo
     */
    public function save(string $pathSave, int $quality = 100)
    {
        $this->output($pathSave, (int) $quality);
    }

    /**
     * Método responsável por escrever na tela a imagem
     *
     * @param string $pathSave
     * @param int $quality
     */
    public function printImage($quality = 100)
    {
     
        header("Content-Type: image/{$this->type}");
        $this->output(null,$quality);exit;  
       
    }

    /**
     * método responsável por criar imagem 
     *
     * @param $pathSave
     * @param integer $quality
     * @return void
     */
    private function output($pathSave, int $quality)
    {
        
        imagealphablending($this->image, true);
        switch($this->type)
        {
            case "jpeg":
                imagejpeg($this->image, $pathSave, $quality);
            break;
            case "png":

                $quality = $quality == 100 ? substr($quality,0, 2) : substr($quality, 0, 1);
                imagepng($this->image, $pathSave, );

            break;
            case "gif":
                imagegif($this->image, $pathSave, $quality);
            break;
        }
    }

    public function destroyImage()
    {
        unlink($this->image);
    }
}