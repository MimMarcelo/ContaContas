<form action="/contas/salvar" method="post">
    <input type="hidden" name="iptId" value="<?= isset($conta)?$conta->getId():'0'; ?>">
    <div class="form-group">
        <label for="iptNome">Conta</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text material-icons">sim_card</span>
            </div>
            <input type="text" class="form-control" name="iptNome" id="iptNome" value="<?= isset($conta)?$conta->getNome():''; ?>" autofocus>
        </div>
    </div>
    <div class="form-group">
        <label for="iptValor">Valor</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">R$</span>
            </div>
            <input type="number" class="form-control" name="iptValor" id="iptValor" step="0.01" min="0" value="<?= isset($conta)?$conta->getValor():''; ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="iptData">Data</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text material-icons">event_note</span>
            </div>
            <input type="date" class="form-control" name="iptData" id="iptData"
            value="<?= date_format(isset($conta)?$conta->getDataAplicacao():new \DateTime(), "Y-m-d"); ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="slcClasse">Classe</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text material-icons">add_to_queue</span>
            </div>
            <select class="form-control" name="slcClasse" id="slcClasse">
                <?php
                $classe_id =  isset($conta)?$conta->getClasse()->getId():"";
                foreach (MimMarcelo\ContaContas\Model\ClasseConta::getAll() as $classe):
                ?>
                <option value="<?= $classe->getId(); ?>" <?= $classe_id==$classe->getId()?"selected":""; ?>><?= $classe->getNome(); ?></option>
            <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <input type="submit" value="Salvar" class="btn btn-primary">
        <input type="reset" value="Limpar" class="btn btn-warning">
        <a href="/contas/" class="btn btn-link">Cancelar</a>
    </div>
</form>
