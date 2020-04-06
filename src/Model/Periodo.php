<?php
namespace MimMarcelo\ContaContas\Model;

use MimMarcelo\ContaContas\Helper\{IteratorAdapter, JSON};
/**
*
*/
class Periodo extends IteratorAdapter{

    use JSON;

    private $total;
    private $totalDespezas;
    private $totalReceitas;
    private $totalPorClasses;

    public function __construct(array $lista = array())
    {
        parent::__construct($lista);
        $this->totalPorClasses = array();
        $this->getTotal();
    }

    public function __get($atributo){
        return $this->$atributo;
    }

    private function getTotal(): void
    {
        $this->total = 0;
        $this->totalDespezas = 0;
        $this->totalReceitas = 0;

        /** @var $conta Conta */
        foreach ($this as $conta) {
            $this->totalPorClasses[$conta->getClasse()->getSigla()] += $conta->getValor();
            if($conta->getClasse()->getTipo() === 'C'){
                $this->total += $conta->getValor();
                $this->totalReceitas += $conta->getValor();
            }
            else if($conta->getClasse()->getTipo() === 'D'){
                $this->total -= $conta->getValor();
                $this->totalDespezas += $conta->getValor();
            }
        }
    }
}
