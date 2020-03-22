<?php

namespace MimMarcelo\ContaContas\Controller;

use MimMarcelo\ContaContas\Model\Conta;
/**
 *
 */
class ContaController
{

    function __construct()
    {
        // code...
    }

    public function processarRequisicao($pagina): void
    {
        if(strpos($pagina, '/contas/inserir') === 0){
            require __DIR__ . "/../../view/conta/form.php";
            return;
        }
        if(strpos($pagina, '/contas/editar/') === 0){
            $id = array_pop(explode("/", $pagina));
            if (is_null($id) || $id === false || $id <= 0) {
                header("Location: /contas");
                return;
            }

            $conta = Conta::getConta($id);
            if(is_null($conta)){
                header("Location: /contas");
                return;
            }

            require __DIR__ . "/../../view/conta/form.php";
            return;
        }
        $contas = Conta::getAll();
        require __DIR__ . "/../../view/conta/listar.php";
    }
}
