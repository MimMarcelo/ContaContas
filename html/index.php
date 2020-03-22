<?php
require __DIR__ . '/../vendor/autoload.php';

use MimMarcelo\ContaContas\Model\Conta;

?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <title>Conta Contas</title>
    </head>
    <body>
        <pre>
            <?php
            $c = new Conta("Hello World");
            print_r($c);
            echo $c->toJSON();

            $d = new Conta();
            echo "Retorno: " .$d->fromJSON('{"Conta":{"nome":"CAERN","valor":39.99,"id":2}}');
            print_r($d);
            echo $d->toJSON();
            ?>

    </body>
</html>
