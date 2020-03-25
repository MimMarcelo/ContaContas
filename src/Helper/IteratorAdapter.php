<?php
namespace MimMarcelo\ContaContas\Helper;
/**
 *
 */
abstract class IteratorAdapter implements \Iterator
{
    /**
     * @var int
     * Armazena a posição atual da lista
     */
    private $posicao = 0;

    /**
     * @var bool
     * Indica se a ordem é reversa
     */
    private $inverso = false;

    /**
     * @var array
     * Lista de itens da coleção
     */
    private $lista;

    public function __construct(array $colecao = array()) {
        $this->lista = $colecao;
        $this->posicao = 0;
        $this->inverso = false;
    }

    public function __get($atributo){
        return $this->$atributo;
    }

    public function rewind() {
        $this->posicao = $this->inverso ? count($this->lista) - 1 : 0;
    }

    public function current() {
        return $this->lista[$this->posicao];
    }

    public function key() {
        return $this->posicao;
    }

    public function next() {
        $this->posicao = $this->posicao + ($this->inverso ? -1 : 1);
    }

    function valid() {
        return isset($this->lista[$this->posicao]);
    }

    public function inverterOrdem(){
        $this->inverso = !$this->inverso;
    }
}
 ?>
