<?php

namespace MimMarcelo\ContaContas\Helper;

/**
 *
 */
trait Validador
{
    private static function validarId($id): bool
    {
        if(!filter_var($id, FILTER_VALIDATE_INT)){
            return false;
        }
        if (is_null($id) || $id === false || $id <= 0) {
            return false;
        }
        return true;
    }
}
