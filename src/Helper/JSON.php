<?php

namespace MimMarcelo\ContaContas\Helper;

/**
*
*/
trait JSON{

    private function getClassName(): string
    {
        return array_pop(explode('\\', get_class($this)));
    }

    public function toJSON(): string
    {
        if($this instanceof IteratorAdapter){
            foreach ($this as $item) {
                $lista[] = $item->toJSON();
            }
            return json_encode(array($this->getClassName() => get_object_vars($this), 'lista' => $lista));
        }
        return json_encode(array($this->getClassName() => get_object_vars($this)));
    }

    public function fromJSON(string $json): int
    {
        $aux = json_decode($json, true);
        if(is_null($aux)){
            return 1;
        }
        if(empty($aux)){
            return 2;
        }

        if(!array_key_exists($this->getClassName(), $aux)){
            return 3;
        }

        $valores = $aux[$this->getClassName()];
        $atributos = array_keys(get_class_vars(get_class($this)));

        foreach($atributos as $atributo){
            $this->$atributo = $valores[$atributo];
        }
        return 0;
    }
}
