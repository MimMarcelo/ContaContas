<form action="/contas/salvar" method="post">
    <input type="hidden" name="iptId" value="<?= isset($conta)?$conta->id:'0'; ?>">
    <div class="form-group">
        <label for="iptNome">Conta</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text bi bi-credit-card"></span>
            </div>
            <input type="text" class="form-control" name="iptNome" id="iptNome" value="<?= isset($conta)?$conta->nome:''; ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="iptValor">Valor</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">R$</span>
            </div>
            <input type="number" class="form-control" name="iptValor" id="iptValor" step="0.01" min="0" value="<?= isset($conta)?$conta->valor:''; ?>">
        </div>
    </div>
    <div class="form-check">
        <div class="form-group">
            <input type="checkbox" class="form-check-input" name="iptReceita" id="iptReceita" <?= isset($conta)?$conta->receita?'checked':'':''; ?>>
            <label class="form-check-label" for="iptReceita">
                <span class="bi bi-file-earmark-plus"></span>
                Receita
            </label>
        </div>
    </div>
    <div class="form-group">
        <input type="submit" value="Salvar" class="btn btn-primary">
        <input type="reset" value="Limpar" class="btn btn-warning">
        <a href="/contas/" class="btn btn-link">Cancelar</a>
    </div>
</form>
