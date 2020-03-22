<?php

use MimMarcelo\ContaContas\Controller\ContaController;

$rotas = [
    '/contas/editar/' => ContaController::class,
    '/contas/editar' => ContaController::class,
    '/contas/inserir' => ContaController::class,
    '/contas/' => ContaController::class,
    '/contas' => ContaController::class,
    '' => ContaController::class,
];

function checarRota($pagina, $rotas){
    foreach ($rotas as $key => $value) {
        if(strpos($pagina, $key) === 0){
            return $key;
        }
    }
    return false;
}
