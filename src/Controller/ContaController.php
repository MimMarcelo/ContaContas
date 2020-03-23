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

    public function processarRequisicao(array $requisicao): void
    {
        $pagina = array_shift($requisicao);
        switch ($pagina) {
            case 'editar':  // Editar chama a mesma página que Inserir, portanto não há 'break' entre eles
                $id = array_shift($requisicao);
                if (is_null($id) || $id === false || $id <= 0) {
                    header("Location: /contas");
                    return;
                }

                $conta = Conta::getConta($id);
                if(is_null($conta)){
                    header("Location: /contas");
                    return;
                }
                //break;

            case 'inserir':
                require __DIR__ . "/../../view/conta/form.php";
                break;

            case 'excluir':
                $id = array_shift($requisicao);
                if (is_null($id) || $id === false || $id <= 0) {
                    header("Location: /contas");
                    return;
                }

                $conta = Conta::getConta($id);
                if(is_null($conta)){
                    header("Location: /contas");
                    return;
                }
                echo "Conta com o ID=$id excluída!";
                break;
            default:
                $contas = Conta::getAll();
                require __DIR__ . "/../../view/conta/listar.php";
                break;
        }
    }
}
