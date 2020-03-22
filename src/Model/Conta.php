<?php

namespace MimMarcelo\ContaContas\Model;

use \MimMarcelo\ContaContas\Helper\JSON;
/**
*
*/
class Conta
{
    use JSON;

    private $nome;
    private $valor;

    function __construct($nome = "", $valor = 0)
    {
        $this->nome = $nome;
        $this->valor = $valor;
    }

    public function __get(string $atributo)
    {
        return $this->$atributo;
    }

}
