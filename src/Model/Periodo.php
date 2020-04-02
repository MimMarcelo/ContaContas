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
            if($conta->receita){
                $this->total += $conta->valor;
                $this->totalReceitas += $conta->valor;
            }
            else{
                $this->total -= $conta->valor;
                $this->totalDespezas += $conta->valor;
            }
        }
    }
}
 ?>
