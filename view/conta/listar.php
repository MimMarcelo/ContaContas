<ul>
    <?php
    // var_dump($contas);
    // $contas->inverterOrdem();
    foreach($contas as $conta): ?>
        <li>
            <?= $conta->receita?"C":"D"; ?>
            <?= " {$conta->nome}: R$ {$conta->valor}"; ?> <a href="/contas/editar/<?= $conta->id; ?>">Editar</a><a href="/contas/excluir/<?= $conta->id; ?>">Excluir</a></li>
    <?php endforeach; ?>
</ul>
<p>Total de receitas: R$ <?=number_format($contas->totalReceitas, 2, ',', '.'); ?></p>
<p>Total de despezas: R$ <?=number_format($contas->totalDespezas, 2, ',', '.'); ?></p>
<p>Total geral: R$ <?=number_format($contas->total, 2, ',', '.'); ?></p>
