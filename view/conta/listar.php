<ul>
    <?php
    // var_dump($contas);
    // $contas->inverterOrdem();
    foreach($contas as $conta): ?>
        <li><?= "{$conta->nome}: R$ {$conta->valor}"; ?> <a href="/contas/editar/<?= $conta->id; ?>">Editar</a><a href="/contas/excluir/<?= $conta->id; ?>">Excluir</a></li>
    <?php endforeach; ?>
</ul>
<p>Total: R$ <?=$contas->getTotal(); ?></p>
