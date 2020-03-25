<?php
namespace MimMarcelo\ContaContas\Model;

use MimMarcelo\ContaContas\Helper\IteratorAdapter;

/**
 *
 */
class Periodo extends IteratorAdapter{

    public function getTotal(): float
    {
        $total = 0;
        /** @var $conta Conta */
        foreach ($this->lista as $conta) {
            $total += $conta->valor;
        }
        return $total;
    }
}
 ?>
