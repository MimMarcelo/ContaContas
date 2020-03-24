<?php

namespace MimMarcelo\ContaContas\Controller;

use MimMarcelo\ContaContas\Model\Conta;
/**
*
*/
class ContaController extends BaseController
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

        $dados = array(
            'titulo' => "Editar conta: {$conta->nome}",
            'conta' => $conta
        );
        $this->showView("conta/form.php", $dados);
    }

    private function inserir(): void
    {
        $dados = array(
            'titulo' => 'Criar Conta'
        );
        $this->showView("conta/form.php", $dados);
    }

    private function listar(): void
    {
        $contas = Conta::getAll();
        $dados = array(
            'titulo' => 'Listar contas',
            'contas' => $contas
        );
        $this->showView("conta/listar.php", $dados);
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

        $this->listar();
        echo "Conta '{$conta->nome}' salva com sucesso!";
    }

    private function excluir($id): void
    {
        $conta = Conta::remover($id);
        if(is_null($conta)){
            header("Location: /contas");
            return;
        }

        $this->listar();
        echo "Conta '{$conta->nome}' removida com sucesso!";
    }

}
