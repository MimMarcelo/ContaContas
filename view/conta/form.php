<form action="/contas/salvar" method="post">
    <input type="hidden" name="iptId" value="<?= is_null($conta)?'0':$conta->id; ?>">
    <div>
        <label for="iptNome">Conta</label>
        <input type="text" name="iptNome" id="iptNome" value="<?= is_null($conta)?'':$conta->nome; ?>">
    </div>
    <div>
        <label for="iptValor">Valor</label>
        <input type="number" name="iptValor" id="iptValor" step="0.01" min="0" value="<?= is_null($conta)?'':$conta->valor; ?>">
    </div>
    <div>
        <input type="submit" value="Salvar">
        <input type="reset" value="Limpar">
        <a href="/contas/">Cancelar</a>
    </div>
</form>
