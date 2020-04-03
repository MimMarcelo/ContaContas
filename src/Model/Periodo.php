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

    public function __construct(array $lista = array())
    {
        parent::__construct($lista);
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
            switch($conta->getClasse()->getTipo()){
                case 'C':
                $this->total += $conta->getValor();
                $this->totalReceitas += $conta->getValor();
                break;
                case 'D':
                $this->total -= $conta->getValor();
                $this->totalDespezas += $conta->getValor();
                break;
            }
        }
    }
}
?>
