<?php

namespace App\Model\View;

abstract class Model{

    /**
     * GUARDA TODOS OS DADOS DA VARIVAVEL
     *
     * @var array $values
     */
    private $values;
    public function setData(array $values)
    {
        $this->values = current($values);
    }

    /**
     * Retorna um array com os valores tratado
     *
     * @return array
     */
    public function getValues()
    {
        return $this->values ?? [];
    }
}