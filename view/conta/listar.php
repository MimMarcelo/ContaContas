<?php $hoje = new \DateTime(); ?>
<form action="/contas/listar_json">
    <div class="form-group">
        <label for="slcMes">Mes</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text material-icons">event_note</span>
            </div>
            <select class="form-control form_get" name="slcMes" id="slcMes">
                <option value="1" <?= date_format($mes, "m")==1?"selected":""; ?>>Jan</option>
                <option value="2" <?= date_format($mes, "m")==2?"selected":""; ?>>Fev</option>
                <option value="3" <?= date_format($mes, "m")==3?"selected":""; ?>>Mar</option>
                <option value="4" <?= date_format($mes, "m")==4?"selected":""; ?>>Abr</option>
                <option value="5" <?= date_format($mes, "m")==5?"selected":""; ?>>Mai</option>
                <option value="6" <?= date_format($mes, "m")==6?"selected":""; ?>>Jun</option>
                <option value="7" <?= date_format($mes, "m")==7?"selected":""; ?>>Jul</option>
                <option value="8" <?= date_format($mes, "m")==8?"selected":""; ?>>Ago</option>
                <option value="9" <?= date_format($mes, "m")==9?"selected":""; ?>>Set</option>
                <option value="10" <?= date_format($mes, "m")==10?"selected":""; ?>>Out</option>
                <option value="11" <?= date_format($mes, "m")==11?"selected":""; ?>>Nov</option>
                <option value="12" <?= date_format($mes, "m")==12?"selected":""; ?>>Dez</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="slcAno">Ano</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text material-icons">event_note</span>
            </div>
            <select class="form-control form_get" name="slcAno" id="slcAno">
                <?php for($ano=(date_format($hoje, "Y")+2); $ano >= 2019; $ano--): ?>
                    <option value="<?= $ano; ?>" <?= date_format($mes, "Y")==$ano?"selected":""; ?>><?= $ano; ?></option>
                <?php endfor; ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label>Consultas pré-definidas</label>
        <input type="button" value="Anterior" class="btn btn-secondary redirecionar" name="acao"
            data-target="/contas/listar_json/<?php
                $hoje->add(date_interval_create_from_date_string('-1 month'));
                echo date_format($hoje, 'm');
                echo '/';
                echo date_format($hoje, 'Y');
            ?>">
        <input type="button" value="Mês Atual" class="btn btn-info redirecionar" name="acao"
            data-target="/contas/listar_json/<?php
                $hoje->add(date_interval_create_from_date_string('1 month'));
                echo date_format($hoje, 'm');
                echo '/';
                echo date_format($hoje, 'Y');
            ?>">
        <input type="button" value="Próximo" class="btn btn-secondary redirecionar" name="acao"
            data-target="/contas/listar_json/<?php
                $hoje->add(date_interval_create_from_date_string('1 month'));
                echo date_format($hoje, 'm');
                echo '/';
                echo date_format($hoje, 'Y');
            ?>">
    </div>
</form>
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
                <th scope="col" onclick="ordenarTabela(this, 'numero')">
                    Valor
                    <span class="material-icons">swap_vert</span>
                </th>
                <th scope="col" onclick="ordenarTabela(this, 'data')">
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
