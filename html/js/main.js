/* Comportamento dos alert da página ******************************************/
$('.alert').on('close.bs.alert', function (event) {
    event.preventDefault();
    $(this).slideUp(1000);
    setInterval(function(){
        $('.alert').remove();
    }, 1010);
});

$('.campo-ajax').on('change', atualizarViaAjax);
$('.botao-ajax').click(atualizarViaAjax);

function atualizarViaAjax() {
    var form = $(this).parents("form");
    var url = $(form).attr("action");
    var funcao = $(form).attr("data-target");

    var target = $(this).attr("data-target");

    var campos = $(form).find('.campo-ajax');
    if(typeof target !== typeof undefined && target !== false){
        var valores = target.split("/");
        for(var i = 0; i < valores.length; i++){
            $(campos[i]).val(parseInt(valores[i]));
        }
    }

    $(campos).each(function(){
        url += "/"+$(this).val();
    });
    getJSON(url, funcao);
}

function getJSON(url, f){
    $("#loading").show();
    $.get(
        url,
        window[f]
    ).always(function(){
        $("#loading").hide();
    });
}
