<?php

namespace App\Core\Tpl\View;

abstract class TplController{

    /**
     * @var string
     * armazena nome da pasta
     */
    private $folder;
    /**
     * @var string
     * armazena nome do arquivo
     */
    private $file;

    /**
     * @var string
     * armazena nome da extensão do arquivo
     */
    protected $ext;
    /**
     * @var string
     * armazena todo o conteúdo para gerar cache
     */
    protected $context;

    /**
     * @var array
     * Armazena todas as variaveis para extrair no cache
     */
    protected $vars = [];


    /**
     * @param $folder PASTA 
     * @param $ext   TIPO DO ARQUIVO 
     */
    public function __construct($folder, $ext = "html")
    {
        $this->folder = $folder;
        $this->ext = $ext;
    }

    /**
     * @param $file
     * Atribui o valor da sprintf que retorna uma string formatada  para variavel $this->file;
     */
    protected function setFile($file)
    {
        $this->file =  sprintf("%s/%s.%s", $this->folder, $file, $this->ext);
    }
    protected function getFile()
    {
        return $this->file;
    }

    /**
     * RETORNA CONTEÚDO
     * @return string RETORNA CAMINHO DO ARQUIVO
     */
    protected function getContext()
    {
        return file_get_contents($this->getFile());
    }

    /**
     * METODO RESPONSÁVEL POR CRIAR AS VARIAVEIS
     */
    protected function replaceVariables()
    {

        if(in_array("string" , array_map("gettype", $this->vars))){


            # CRIA UMA STRING PARA SER ENCONTRADA NO CONTEÚDO 
            $search = array_map(function($value){
                return "{{" . $value . "}}";
            }, array_keys($this->vars));

            # CRIA UMA STRING PARA SUBSTITUIR O QUE FOI ENCONTRADA NO CONTEÚDO
            $replace = array_map(function($value){
                return "<?=$" . $value . ";?>";
            }, array_keys($this->vars));

            //  substitui {{varavel}} pela $variavel PHP; 
            $this->context = str_replace( $search ,  $replace , $this->context);
        }
     

    }
    /**
     * METODO RESPONSÁVEL POR CRIAR OS ARRAY
     */
    protected function replaceArray()
    {
        if(in_array("array" , array_map("gettype", $this->vars))){

            // cria uma espressão, para veriifica se existe 
            // {{chave.valor}}
            $matches = self::verifyExpress('/{{(.*?)\.(.*?)\}}/', $this->context);

            // combina chave e o valor encontrado na espressão regular 
            $magerArray = array_combine($matches[1], $matches[2]);
            
            foreach ($magerArray as $key => $value) {
                $search []  = '{{'.$key.'.'.$value.'}}';
                $replace[] = '<?=$'.$key.'["'.$value.'"];?>';
            }
            
            //  substitui {{chave.valor}} pela $array["chave"] PHP; 
            $this->context = str_replace( $search ,  $replace , $this->context);

        }
    }

    /**
     * método responsável por gerar o foreache
     */

     protected function replaceLoop()
     {

        if(in_array("array" , array_map("gettype", $this->vars))){
            // cria uma espressão, para localizar um loop no html
            $matches = self::verifyExpress("/{{loop=(.*?)}}/", $this->context);
            $loop = array_map(function($values){
                return '<?php if(isset($'.$values.')) 
                foreach($'.$values.' as $key => $value){ ?>';
            }, $matches[1]);

            $this->context = str_replace($matches[0], $loop, $this->context);
            $this->context = str_replace("{{/loop}}", "<?php } ?> \n\r", $this->context);
        }
     }

     protected function replaceFunction()
     {

        
        // cria uma espressão, para localizar um loop no html
        $matches = self::verifyExpress("/{{function=(.*?)}}/", $this->context);
        
        $callfunction = array_map(function($values){
            return '
            <?php 
            if(function_exists("'.$values.'")) {
            echo '.$values.'();}
            ?>';
        }, $matches[1]);

        $this->context = str_replace($matches[0], $callfunction, $this->context);
        
     }

    /**
     * ESPRESSÃO REGULAR
     * @param $patters
     * @param $context
     * @return array
     * RETORNA O QUE É RETORNADO PELA ESPRESSÃO 
     * PREG_MATCH_ALL
     */
    private static function verifyExpress($patters, $context): array
    {
        preg_match_all($patters, $context, $matches);
        return $matches;
    }
    
}