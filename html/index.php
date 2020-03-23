<?php
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config/rotas.php';

/*
 * Obtem a URL => $_SERVER['PATH_INFO']
 * Converte todos os caracteres para minúsculo => strtolower()
 * Separa a URL em um array usando como separador o caracter '/' => explode()
 */
$requisicao = explode("/", strtolower($_SERVER['PATH_INFO']));
array_shift($requisicao); // Como a URL começa com '/', primeiro elemento é sempre vazio

//Checa apenas o controlador $requisicao[1]
$controllerClass = getController(array_shift($requisicao), $rotas);
if(is_null($controllerClass)){
    echo "URL: " . strtolower($_SERVER['PATH_INFO']);
    echo "<br>Página não encontrada<pre>";
    print_r($rotas);
    http_response_code(404);
    exit();
}

/*
 * Cria o controller específico e
 * inclui o conteúdo da página
 */
$controller = new $controllerClass();
require __DIR__ . "/../view/cabecalho.php";
$controller->processarRequisicao($requisicao);
require __DIR__ . "/../view/rodape.php";
