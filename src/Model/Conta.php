<?php

namespace MimMarcelo\ContaContas\Model;

/**
 *
 */
class Conta
{
  private $name;

  function __construct($name)
  {
    $this->name = $name;
  }

  public function __get(string $attr){
    return $this->$attr;
  }
}
