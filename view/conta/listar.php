<ul>
    <?php
    foreach($contas as $conta): ?>
        <li><?= "{$conta->nome}: R$ {$conta->valor}"; ?> <a href="/contas/editar/<?= $conta->id; ?>">Editar</a></li>
    <?php endforeach; ?>
</ul>
