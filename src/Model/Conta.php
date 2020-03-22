<?php

namespace MimMarcelo\ContaContas\Model;

use \MimMarcelo\ContaContas\Helper\JSON;
/**
*
*/
class Conta
{
    use JSON;

    private $id;
    private $nome;
    private $valor;

    function __construct($nome = "", $valor = 0, $id = 0)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->valor = $valor;
    }

    public function __get(string $atributo)
    {
        return $this->$atributo;
    }

    public static function getAll(): array
    {
        $c = new Conta("COSERN", 97.45, 1);
        $d = new Conta();
        $d->fromJSON('{"Conta":{"nome":"CAERN","valor":39.99,"id":2}}');
        $e = new Conta("Cabo Telecom", 142.32, 3);
        $f = new Conta("NetFlix", 32.99, 4);

        $contas = array();
        $contas[] = $c;
        $contas[] = $d;
        $contas[] = $e;
        $contas[] = $f;
        return $contas;
    }

    public static function getConta(int $id): ?Conta
    {
        $contas = Conta::getAll();
        foreach ($contas as $conta) {
            if($conta->id === $id){
                return $conta;
            }
        }
        return null;
    }
}
