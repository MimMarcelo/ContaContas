/* Comportamento dos alert da página ******************************************/
$('.alert').on('close.bs.alert', function (event) {
    event.preventDefault();
    $(this).slideUp(1000);
    setInterval(function(){
        $('.alert').remove();
    }, 1010);
});

$('.form_get').on('change', function(){
    var form = $(this).parents("form");
    var url = $(form).attr("action");

    var allFields = $(form).find('.form_get');
    $(allFields).each(function(){
        url += "/"+$(this).val();
    });
    getJSON(url);
});

$('.redirecionar').click(function(){
    getJSON($(this).attr('data-target'));
});
function getJSON(url){
    $.get(
        url,
        atualizarTabela
    );
}
function novaLinha(n, json) {

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

    $(thN).text(n);
    $(tdReceita).text(json.Conta.receita?"C":"D");
    $(tdNome).text(json.Conta.nome);
    $(tdValor).text(json.Conta.valor);
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

function atualizarTabela(data) {
    var json = JSON.parse(data);
    var t = $('tbody')
    t.empty();
    var n = 0;
    $(json.lista).each(function(){
        var linha = novaLinha(++n, JSON.parse(this));
        t.append(linha);
    });

}

function redirecionarPara(url){
    window.location.replace(url);
}
