<?php

namespace MimMarcelo\ContaContas\Controller;
/**
 *
 */
class BaseController
{
    protected function showView(string $pagina, array $dados = null): void
    {
        extract($dados);
        $dir = __DIR__ . "/../../view/";
        require $dir."cabecalho.php";
        require $dir.$pagina;
        require $dir."rodape.php";
    }
}
 ?>
