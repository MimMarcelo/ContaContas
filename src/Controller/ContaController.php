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
        $json = false;
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

            case 'listar_json':
            $json = true;
            case '':
            case 'listar':
            $this->listar($requisicao, $json);
            break;

            case 'json':
            $this->getJSON($requisicao);
            break;
        }
    }

    private function editar($id): void
    {
        $conta = Conta::getConta($id);
        if(is_null($conta)){
            $this->setMensagemErro(array('Não foi possível carregar os dados da conta', 'Conta não encontrada'));
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

    private function listar($periodo, $json): void
    {
        $mes = array_shift($periodo);
        $ano = array_shift($periodo);

        if(!isset($mes) || $mes < 0 || $mes > 12){
            $mes = date_format(new \DateTime(), "m");
        }
        if(!isset($ano) || $ano < 2019 || $ano > (date_format(new \DateTime(), "Y")+2)){
            $ano = date_format(new \DateTime(), "Y");
        }

        $date = new \DateTime();
        $date->setDate($ano, $mes ,"01");

        $dInicial = date_format($date, "Y-m-d");

        $date->add(date_interval_create_from_date_string('1 month -1 day'));
        $dFinal = date_format($date, "Y-m-d");

        $contas = Conta::getAll($dInicial, $dFinal);

        if($json){
            echo $contas->toJSON();
            return;
        }
        
        $dados = array(
            'titulo' => 'Listar contas',
            'contas' => $contas,
            'mes' => $date
        );
        $this->showView("conta/listar.php", $dados);
    }

    private function salvar(): void
    {
        $id = filter_input(INPUT_POST, 'iptId', FILTER_VALIDATE_INT);
        $nome = filter_input(INPUT_POST, 'iptNome', FILTER_SANITIZE_STRING);
        $valor = filter_input(INPUT_POST, 'iptValor', FILTER_VALIDATE_FLOAT);
        $receita = filter_input(INPUT_POST, 'iptReceita', FILTER_VALIDATE_BOOLEAN);
        $dataAplicacao = filter_input(INPUT_POST, 'iptData');

        $params = array(
            'id' => $id,
            'nome' => $nome,
            'valor' => $valor,
            'receita' => $receita,
            'dataAplicacao' => $dataAplicacao,
        );

        $conta = Conta::salvar($params);
        if(is_null($conta)){
            $this->setMensagemErro(array('Não foi possível salvar os dados da conta'));
            header("Location: /contas");
            return;
        }

        $this->setMensagemSucesso(array('Conta "' . $conta->nome . '" salva com sucesso!'));
        header("Location: /contas");
    }

    private function excluir($id): void
    {
        $conta = Conta::remover($id);
        if(is_null($conta)){
            $this->setMensagemErro(array('Não foi possível excluir a conta', 'Conta não encontrada'));
            header("Location: /contas");
            return;
        }

        $this->setMensagemSucesso(array('Conta "' . $conta->nome . '" excluida com sucesso!'));
        header("Location: /contas");
    }

    private function getJSON($requisicao)
    {
        $metodo = array_shift($requisicao);
        switch ($metodo) {
            case 'get':
                $conta = Conta::getConta(array_shift($requisicao));
                echo $conta->toJSON();
                break;
            case 'get_all':
                $conta = Conta::getAll();
                echo $conta->toJSON();
                break;
        }
    }

}
