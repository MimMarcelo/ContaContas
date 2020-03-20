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
    <?php
    $c = new Conta("Hello World");
    echo $c->name;
     ?>

  </body>
</html>
