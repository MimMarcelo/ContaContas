<?php

namespace MimMarcelo\ContaContas\Controller;

use MimMarcelo\ContaContas\Model\ClasseConta;
/**
*
*/
class ClasseContaController extends BaseController
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
            $this->listar($json);
            break;
        }
    }

    private function editar($id): void
    {
        $classe = ClasseConta::get($id);
        if(is_null($classe)){
            $this->setMensagemErro(array('Não foi possível carregar os dados da classe de conta', 'Classe não encontrada'));
            header("Location: /classesconta");
            return;
        }

        $dados = array(
            'titulo' => "Editar classe de conta: {$classe->getNome()}",
            'classe' => $classe
        );
        $this->showView("classesconta/form.php", $dados);
    }

    private function inserir(): void
    {
        $dados = array(
            'titulo' => 'Criar classe de conta'
        );
        $this->showView("classesconta/form.php", $dados);
    }

    private function listar($json): void
    {
        $classes = ClasseConta::getAll();

        if($json){
            echo $classes->toJSON();
            return;
        }

        $dados = array(
            'titulo' => 'Listar classes de conta',
            'classes' => $classes
        );
        $this->showView("classesconta/listar.php", $dados);
    }

    private function salvar(): void
    {
        $id = filter_input(INPUT_POST, 'iptId', FILTER_VALIDATE_INT);
        $sigla = filter_input(INPUT_POST, 'iptSigla', FILTER_SANITIZE_STRING);
        $nome = filter_input(INPUT_POST, 'iptNome', FILTER_SANITIZE_STRING);
        $tipo = filter_input(INPUT_POST, 'slcTipo', FILTER_VALIDATE_INT);

        $params = array(
            'id' => $id,
            'sigla' => $sigla,
            'nome' => $nome,
            'tipo' => $tipo,
        );

        $classe = ClasseConta::salvar($params);
        if(is_null($classe)){
            $this->setMensagemErro(array('Não foi possível salvar os dados da classe de conta'));
            header("Location: /classesconta");
            return;
        }

        $this->setMensagemSucesso(array('Classe de conta "' . $classe->getNome() . '" salva com sucesso!'));
        header("Location: /classesconta");
    }

    private function excluir($id): void
    {
        $classe = ClasseConta::remover($id);
        if(is_null($classe)){
            $this->setMensagemErro(array('Não foi possível excluir a classe de conta', 'Classe não encontrada'));
            header("Location: /classesconta");
            return;
        }

        $this->setMensagemSucesso(array('Classe de conta "' . $classe->getNome() . '" excluida com sucesso!'));
        header("Location: /classesconta");
    }
}
