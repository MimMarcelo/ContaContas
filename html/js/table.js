
function novaLinha(json) {

    var linha = $("<tr>");
    var thN = $("<th>");
    var tdReceita = $("<td>");
    var tdNome = $("<td>");
    var tdValor = $("<td>");
    var tdData = $("<td>");
    var tdEditar = $("<td>");
    var tdExcluir = $("<td>");
    var aEditar = $("<a>");
    var aExcluir = $("<a>");
    var sEditar = $("<span>");
    var sExcluir = $("<span>");

    var dataAplicacao = new Date(json.Conta.dataAplicacao.date);
    var dia = dataAplicacao.getDate();
    if(dia<10) dia = "0"+dia;
    var mes = dataAplicacao.getMonth()+1;
    if(mes<10) mes = "0"+mes;

    $(thN).text(json.Conta.id);
    $(tdReceita).text(json.Conta.classe.sigla);
    $(tdNome).text(json.Conta.nome);
    $(tdValor).text("R$ " + json.Conta.valor);
    $(tdData).text(dia+"/"+mes+"/"+dataAplicacao.getFullYear());

    $(aEditar).addClass("btn");
    $(aEditar).addClass("btn-warning");
    $(aEditar).attr("href", "/contas/editar/"+json.Conta.id);
    $(sEditar).addClass("material-icons");
    $(sEditar).text("edit");
    $(aEditar).append(sEditar);
    $(tdEditar).append(aEditar);

    $(aExcluir).addClass("btn");
    $(aExcluir).addClass("btn-danger");
    $(aExcluir).attr("href", "/contas/excluir/"+json.Conta.id);
    $(sExcluir).addClass("material-icons");
    $(sExcluir).text("delete_sweep");
    $(aExcluir).append(sExcluir);
    $(tdExcluir).append(aExcluir);

    linha.append(thN);
    linha.append(tdReceita);
    linha.append(tdNome);
    linha.append(tdValor);
    linha.append(tdData);
    linha.append(tdEditar);
    linha.append(tdExcluir);
    return linha;
}

function atualizarTabelaContas(data) {
    var json = JSON.parse(data);
    var t = $('tbody')
    t.empty();
    $(json.lista).each(function(){
        var linha = novaLinha(JSON.parse(this));
        t.append(linha);
    });
    // console.log(json.Periodo);
    // console.log($("#totalReceitas"));
    $("#totalReceitas").text(json.Periodo.totalReceitas);
    $("#totalDespezas").text(json.Periodo.totalDespezas);
    $("#totalGeral").text(json.Periodo.total);
    var totais = $("#totais");
    totais.empty();
    for(classe in json.Periodo.totalPorClasses){
        var li = $("<li>");
        li.text('Total com "' + classe +'": ' + json.Periodo.totalPorClasses[classe]);
        totais.append(li);
    }
}

/* Função de ordenação de tabelas *********************************************
* Fonte: https://www.w3schools.com/howto/howto_js_sort_table.asp
*
* Foram feitas alterações do código original, pois não ordenava os números
* precedidos de texto de forma adequada.
* As adaptações foram feitas utilizando JQuery
* Foi traduzida para o português
******************************************************************************/
function ordenarTabela(elemento, tipo = '') {
    // Variáveis que representam elementos/conteúdos da tabela
    var linhas, linhaAtual, linhaSeguinte, conteudoAtual, conteudoSeguinte, nColuna;

    // Variáveis que apoiam a funcionalidade
    var continuarOrdenando, i, deveTrocar, ordemAscendente, contadorDeTrocas;

    // Define os valores iniciais
    nColuna = $(elemento).index() + 1; // +1, pois para os seletores CSS a primeira posição é 1
    ordemAscendente = true;
    continuarOrdenando = true;
    contadorDeTrocas = 0

    // Repete as verificações até que continuarOrdenando = false
    while (continuarOrdenando) {
        continuarOrdenando = false;

        // Obtém a sequência atual de linhas
        linhas = $(elemento).parents('table').find("tbody tr");

        // Percorre todas as linhas do tbody da tabela
        for (i = 0; i < (linhas.length - 1); i++) {
            deveTrocar = false;

            // Pega referências para a linha atual e a próxima
            linhaAtual = $(linhas[i]).find(" *:nth-child("+nColuna+")");
            linhaSeguinte = $(linhas[i + 1]).find(" *:nth-child("+nColuna+")");

            // Pega o conteúdo da célula, distinguindo se é número, data ou texto comum
            switch (tipo) {
                case 'numero':
                conteudoAtual = Number(linhaAtual.text().match(/\d+/g).join('.'));
                conteudoSeguinte = Number(linhaSeguinte.text().match(/\d+/g).join('.'));
                break;
                case 'data':
                conteudoAtual = linhaAtual.text().substring(6);
                conteudoAtual += linhaAtual.text().substring(3, 5);
                conteudoAtual += linhaAtual.text().substring(0, 2);
                conteudoSeguinte = linhaSeguinte.text().substring(6);
                conteudoSeguinte += linhaSeguinte.text().substring(3, 5);
                conteudoSeguinte += linhaSeguinte.text().substring(0, 2);
                break;
                default:
                conteudoAtual = linhaAtual.text().toLowerCase();
                conteudoSeguinte = linhaSeguinte.text().toLowerCase();

            }

            // Verifica se as duas linhas devem trocar de lugar
            if (ordemAscendente) {
                if (conteudoAtual > conteudoSeguinte) {
                    deveTrocar= true;
                    break;
                }
            } else {
                if (conteudoAtual < conteudoSeguinte) {
                    deveTrocar = true;
                    break;
                }
            }
        }

        if (deveTrocar) {
            // Se deveTrocar = true, então realiza a inversão de posições
            linhas[i].parentNode.insertBefore(linhas[i + 1], linhas[i]);
            continuarOrdenando = true;
            contadorDeTrocas ++;
        } else {
            // Se contadorDeTrocas = 0 e a ordem está definida como ascendente, inverter a ordenação
            if (contadorDeTrocas == 0 && ordemAscendente) {
                ordemAscendente = false;
                continuarOrdenando = true;
            }
        }
    }
}
