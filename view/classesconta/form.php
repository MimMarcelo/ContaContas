<form action="/classesconta/salvar" method="post">
    <input type="hidden" name="iptId" value="<?= isset($classe)?$classe->getId():'0'; ?>">
    <div class="form-group">
        <label for="iptSigla">Sigla</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text material-icons">sim_card</span>
            </div>
            <input type="text" class="form-control" name="iptSigla" id="iptSigla" value="<?= isset($classe)?$classe->getSigla():''; ?>" autofocus>
        </div>
    </div>
    <div class="form-group">
        <label for="iptNome">Classe</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text material-icons">sim_card</span>
            </div>
            <input type="text" class="form-control" name="iptNome" id="iptNome" value="<?= isset($classe)?$classe->getNome():''; ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="slcTipo">Tipo de classe</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text material-icons">add_to_queue</span>
            </div>
            <select class="form-control" name="slcTipo" id="slcTipo">
                <?php $tipo =  isset($classe)?$classe->getTipo():-1; ?>
                <option value="-1" <?= $tipo=='D'?"selected":""; ?>>Despeza</option>
                <option value="1" <?= $tipo=='C'?"selected":""; ?>>Receita</option>
                <option value="0" <?= $tipo=='N'?"selected":""; ?>>Neutro</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <input type="submit" value="Salvar" class="btn btn-primary">
        <input type="reset" value="Limpar" class="btn btn-warning">
        <a href="/classesconta/" class="btn btn-link">Cancelar</a>
    </div>
</form>
