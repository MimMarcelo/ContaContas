<form action="/contas/salvar" method="post">
    <input type="hidden" name="iptId" value="<?= isset($conta)?$conta->id:'0'; ?>">
    <div class="form-group">
        <label for="iptNome">Conta</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <svg>
                        <path fill-rule="evenodd" d="M14 3H2a1 1 0 00-1 1v8a1 1 0 001 1h12a1 1 0 001-1V4a1 1 0 00-1-1zM2 2a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V4a2 2 0 00-2-2H2z" clip-rule="evenodd"/>
                        <rect width="3" height="3" x="2" y="9" rx="1"/>
                        <path d="M1 5h14v2H1z"/>
                    </svg>
                </span>
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
                <svg class="bi bi-file-earmark-plus" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9 1H4a2 2 0 00-2 2v10a2 2 0 002 2h5v-1H4a1 1 0 01-1-1V3a1 1 0 011-1h5v2.5A1.5 1.5 0 0010.5 6H13v2h1V6L9 1z"/>
                    <path fill-rule="evenodd" d="M13.5 10a.5.5 0 01.5.5v2a.5.5 0 01-.5.5h-2a.5.5 0 010-1H13v-1.5a.5.5 0 01.5-.5z" clip-rule="evenodd"/>
                    <path fill-rule="evenodd" d="M13 12.5a.5.5 0 01.5-.5h2a.5.5 0 010 1H14v1.5a.5.5 0 01-1 0v-2z" clip-rule="evenodd"/>
                </svg>
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
