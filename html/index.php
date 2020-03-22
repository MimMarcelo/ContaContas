<?php
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config/rotas.php';

$pagina = strtolower($_SERVER['PATH_INFO']);
$caminho = checarRota($pagina, $rotas);
if($caminho === false){
    echo "Página: " . $pagina;
    echo "<br>Página não encontrada<pre>";
    print_r($rotas);
    http_response_code(404);
    exit();
}

$controllerClass = $rotas[$caminho];
$controller = new $controllerClass();
require __DIR__ . "/../view/cabecalho.php";
$controller->processarRequisicao($pagina);
require __DIR__ . "/../view/rodape.php";
