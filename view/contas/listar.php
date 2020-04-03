<?php $hoje = new \DateTime(); ?>
<form action="/contas/listar_json" data-target="atualizarTabelaContas">
    <div class="form-group">
        <label for="slcMes">Mes</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text material-icons">event_note</span>
            </div>
            <select class="form-control campo-ajax" name="slcMes" id="slcMes">
                <?php $numero_mes = date_format($hoje, "m"); ?>
                <option value="1" <?= $numero_mes==1?"selected":""; ?>>Jan</option>
                <option value="2" <?= $numero_mes==2?"selected":""; ?>>Fev</option>
                <option value="3" <?= $numero_mes==3?"selected":""; ?>>Mar</option>
                <option value="4" <?= $numero_mes==4?"selected":""; ?>>Abr</option>
                <option value="5" <?= $numero_mes==5?"selected":""; ?>>Mai</option>
                <option value="6" <?= $numero_mes==6?"selected":""; ?>>Jun</option>
                <option value="7" <?= $numero_mes==7?"selected":""; ?>>Jul</option>
                <option value="8" <?= $numero_mes==8?"selected":""; ?>>Ago</option>
                <option value="9" <?= $numero_mes==9?"selected":""; ?>>Set</option>
                <option value="10" <?= $numero_mes==10?"selected":""; ?>>Out</option>
                <option value="11" <?= $numero_mes==11?"selected":""; ?>>Nov</option>
                <option value="12" <?= $numero_mes==12?"selected":""; ?>>Dez</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="slcAno">Ano</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text material-icons">event_note</span>
            </div>
            <select class="form-control campo-ajax" name="slcAno" id="slcAno">
                <?php for($ano=(date_format($hoje, "Y")+2); $ano >= 2019; $ano--): ?>
                    <option value="<?= $ano; ?>" <?= date_format($hoje, "Y")==$ano?"selected":""; ?>><?= $ano; ?></option>
                <?php endfor; ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label>Consultas pré-definidas</label>
        <input type="button" value="Anterior" class="btn btn-secondary botao-ajax"
            data-target="<?php
                $hoje->add(date_interval_create_from_date_string('-1 month'));
                echo date_format($hoje, 'm');
                echo '/'.date_format($hoje, 'Y');
            ?>">
        <input type="button" value="Mês Atual" class="btn btn-info botao-ajax"
            data-target="<?php
                $hoje->add(date_interval_create_from_date_string('1 month'));
                echo date_format($hoje, 'm');
                echo '/'.date_format($hoje, 'Y');
            ?>">
        <input type="button" value="Próximo" class="btn btn-secondary botao-ajax"
            data-target="<?php
                $hoje->add(date_interval_create_from_date_string('1 month'));
                echo date_format($hoje, 'm');
                echo '/'.date_format($hoje, 'Y');
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
                    Classe
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
            foreach($contas as $conta): ?>
                <tr>
                    <th scope="row"><?= $conta->getId(); ?></th>
                    <td><?= $conta->getClasse() ?></td>
                    <td><?= $conta->getNome(); ?></td>
                    <td><?= "R$ {$conta->getValor()}"; ?></td>
                    <td><?= date_format($conta->getDataAplicacao(), 'd/m/Y'); ?></td>
                    <td>
                        <a href="/contas/editar/<?= $conta->getId(); ?>" class="btn btn-warning">
                            <span class="material-icons">edit</span>
                        </a>
                    </td>
                    <td>
                        <a href="/contas/excluir/<?= $conta->getId(); ?>" class="btn btn-danger">
                        <span class="material-icons">delete_sweep</span>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<p>Total de receitas: R$ <span id="totalReceitas"><?=number_format($contas->totalReceitas, 2, ',', '.'); ?></span></p>
<p>Total de despezas: R$ <span id="totalDespezas"><?=number_format($contas->totalDespezas, 2, ',', '.'); ?></span></p>
<p>Total geral: R$ <span id="totalGeral"><?=number_format($contas->total, 2, ',', '.'); ?></span></p>
