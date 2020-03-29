<?php
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config/rotas.php';

/*
 * Obtem a URL => $_SERVER['PATH_INFO']
 * Converte todos os caracteres para minúsculo => strtolower()
 * Separa a URL em um array usando como separador o caracter '/' => explode()
 */
$uri = strtolower(filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_SANITIZE_STRING));
$requisicao = array();
if(isset($uri)){ //Resolve problema no Windows
    $requisicao = explode("/", $uri);
}
// Como a URL começa com '/', primeiro elemento é sempre vazio =>
 array_shift($requisicao);

// Obtém o pedido do usuário => $requisicao[1]
$pedido = array_shift($requisicao);

// Busca pela classe controladora correspondente ao pedido do usuário
$classeControladora = getController($pedido, $rotas);
if(is_null($classeControladora)){
    echo "URL: " . strtolower($_SERVER['PATH_INFO']);
    echo "<br>Pedido: $pedido<pre>";
    echo "<br>Página não encontrada<pre>";
    print_r($rotas);
    http_response_code(404);
    exit();
}

session_start();
/*
 * Cria o controller específico e
 * Processa a requisição
 */
$controller = new $classeControladora();
$controller->processarRequisicao($requisicao);
