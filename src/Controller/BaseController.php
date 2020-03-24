<?php

namespace MimMarcelo\ContaContas\Controller;

use MimMarcelo\ContaContas\Helper\MensagemFlash;
/**
 *
 */
class BaseController
{
    use MensagemFlash;

    protected function showView(string $pagina, array $dados = null): void
    {
        extract($dados);
        $dir = __DIR__ . "/../../view/";
        
        require $dir."cabecalho.php";
        require $dir."mensagemFlash.php";
        require $dir.$pagina;
        require $dir."rodape.php";
    }
}
 ?>
