<?php

use MimMarcelo\ContaContas\Controller\ContaController;

// Lista de todos os Controllers possíveis na aplicação
$rotas = [
    'contas' => ContaController::class,
    '' => ContaController::class,
];

/**
 * Verifica se há um Controller para o caminho especificado
 * Se houver, retorna o nome do Controller (nome da classe)
 * Caso negativo, retorna null
 */
function getController($requisicao, $rotas): ?string
{
    foreach ($rotas as $key => $value) {
        // echo "'$caminho' == '$key'<br>";
        if(strcmp($requisicao, $key) === 0){
            return $rotas[$key];
        }
    }
    return null;
}
