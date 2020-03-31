<div class="table-responsive">
    <table class="table table-hover table-bordered">
        <thead class="thead-dark">
            <tr>
                <th scope="col" onclick="ordenarTabela(this)">
                    #
                    <span class="material-icons">swap_vert</span>
                </th>
                <th scope="col" onclick="ordenarTabela(this)">
                    C/D
                    <span class="material-icons">swap_vert</span>
                </th>
                <th scope="col" onclick="ordenarTabela(this)">
                    Nome
                    <span class="material-icons">swap_vert</span>
                </th>
                <th scope="col" onclick="ordenarTabela(this, true)">
                    Valor
                    <span class="material-icons">swap_vert</span>
                </th>
                <th scope="col" onclick="ordenarTabela(this)">
                    Data
                    <span class="material-icons">swap_vert</span>
                </th>
                <th scope="col">Editar</th>
                <th scope="col">Excluir</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $n = 0;
            foreach($contas as $conta): ?>
                <tr>
                    <th scope="row"><?= ++$n; ?></th>
                    <td><?= $conta->receita?"C":"D"; ?></td>
                    <td><?= $conta->nome; ?></td>
                    <td><?= "R$ {$conta->valor}"; ?></td>
                    <td><?= date_format($conta->dataAplicacao, 'd/m/Y'); ?></td>
                    <td>
                        <a href="/contas/editar/<?= $conta->id; ?>" class="btn btn-warning">
                            <span class="material-icons">edit</span>
                        </a>
                    </td>
                    <td>
                        <a href="/contas/excluir/<?= $conta->id; ?>" class="btn btn-danger">
                        <span class="material-icons">delete_sweep</span>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<p>Total de receitas: R$ <?=number_format($contas->totalReceitas, 2, ',', '.'); ?></p>
<p>Total de despezas: R$ <?=number_format($contas->totalDespezas, 2, ',', '.'); ?></p>
<p>Total geral: R$ <?=number_format($contas->total, 2, ',', '.'); ?></p>
