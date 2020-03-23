<?php

namespace MimMarcelo\ContaContas\Controller;

use MimMarcelo\ContaContas\Model\Conta;
/**
*
*/
class ContaController
{
    public function processarRequisicao(array $requisicao): void
    {
        $pagina = array_shift($requisicao);
        switch ($pagina) {
            case 'editar':
            $this->editar(array_shift($requisicao));
            break;

            case 'inserir':
            $this->inserir();
            break;

            case 'excluir':
            $this->excluir(array_shift($requisicao));
            break;

            case 'salvar':
            $this->salvar();
            break;

            default:
            $this->listar();
            break;
        }
    }

    private function editar($id): void
    {
        $conta = Conta::getConta($id);
        if(is_null($conta)){
            header("Location: /contas");
            return;
        }

        require __DIR__ . "/../../view/conta/form.php";
    }

    private function excluir($id): void
    {
        if(!Conta::remover($id)){
            header("Location: /contas");
            return;
        }

        echo "Conta com o ID=$id excluída!";

    }

    private function inserir(): void
    {
        require __DIR__ . "/../../view/conta/form.php";
    }

    private function listar(): void
    {
        $contas = Conta::getAll();

        require __DIR__ . "/../../view/conta/listar.php";
    }

    private function salvar(): void
    {
        $id = filter_input(INPUT_POST, 'iptId', FILTER_VALIDATE_INT);
        $nome = filter_input(INPUT_POST, 'iptNome', FILTER_SANITIZE_STRING);
        $valor = filter_input(INPUT_POST, 'iptValor', FILTER_VALIDATE_FLOAT);
        $conta = Conta::salvar($id, $nome, $valor);
        if(is_null($conta)){
            header("Location: /contas");
            return;
        }
        echo "Conta ID={$conta->id} salva com sucesso!";
    }
}
