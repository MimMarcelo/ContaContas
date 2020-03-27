<?php
namespace MimMarcelo\ContaContas\Helper;
/**
 *
 */
trait MensagemFlash
{
    private function setMensagem(string $tipo, string $titulo, array $mensagens): void
    {
        $msg = array(
            "tipo" => $tipo,
            "titulo" => $titulo,
            "mensagens" => $mensagens
        );
        $_SESSION["mensagem"] = $msg;
    }

    public function setMensagemSucesso(array $mensagens): void
    {
        $this->setMensagem('success', 'Sucesso', $mensagens);
    }

    public function setMensagemErro(array $mensagens): void
    {
        $this->setMensagem('danger', 'Falha', $mensagens);
    }
}
 ?>
