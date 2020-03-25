<form action="/contas/salvar" method="post">
    <input type="hidden" name="iptId" value="<?= isset($conta)?$conta->id:'0'; ?>">
    <div>
        <label for="iptNome">Conta</label>
        <input type="text" name="iptNome" id="iptNome" value="<?= isset($conta)?$conta->nome:''; ?>">
    </div>
    <div>
        <label for="iptValor">Valor</label>
        <input type="number" name="iptValor" id="iptValor" step="0.01" min="0" value="<?= isset($conta)?$conta->valor:''; ?>">
    </div>
    <div>
        <label for="iptReceita">Receita</label>
        <input type="checkbox" name="iptReceita" id="iptReceita" <?= isset($conta)?$conta->receita?'checked':'':''; ?>>
    </div>
    <div>
        <input type="submit" value="Salvar">
        <input type="reset" value="Limpar">
        <a href="/contas/">Cancelar</a>
    </div>
</form>
