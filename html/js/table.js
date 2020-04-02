
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
