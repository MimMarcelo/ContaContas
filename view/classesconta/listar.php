<div class="table-responsive">
    <table class="table table-hover table-bordered">
        <thead class="thead-dark">
            <tr>
                <th scope="col" onclick="ordenarTabela(this)">
                    #
                    <span class="material-icons">swap_vert</span>
                </th>
                <th scope="col" onclick="ordenarTabela(this)">
                    Tipo
                    <span class="material-icons">swap_vert</span>
                </th>
                <th scope="col" onclick="ordenarTabela(this)">
                    Sigla
                    <span class="material-icons">swap_vert</span>
                </th>
                <th scope="col" onclick="ordenarTabela(this)">
                    Nome
                    <span class="material-icons">swap_vert</span>
                </th>
                <th scope="col">Editar</th>
                <th scope="col">Excluir</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($classes as $classe): ?>
                <tr>
                    <th scope="row"><?= $classe->getId(); ?></th>
                    <td><?= $classe->getTipo(); ?></td>
                    <td><?= $classe->getSigla(); ?></td>
                    <td><?= $classe->getNome(); ?></td>
                    <td>
                        <a href="/classesconta/editar/<?= $classe->getId(); ?>" class="btn btn-warning">
                            <span class="material-icons">edit</span>
                        </a>
                    </td>
                    <td>
                        <a href="/classesconta/excluir/<?= $classe->getId(); ?>" class="btn btn-danger">
                        <span class="material-icons">delete_sweep</span>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
