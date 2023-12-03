<script>
    //Define a URL para deletar Currency
    let url_base = "{{route('currencies.destroy', ':id')}}";

    /***
     * Envia dados para salvar Currency
     */
    $('form[name="formCurrency"]').submit(function(e){
        e.preventDefault();
        $.ajax({
            url: "{{route('currencies.store')}}",
            type: "post",
            data: $(this).serialize(),
            dataType: "json",
            success: function(response){
                message(response, ".table");
                $("#currencyModal").modal('toggle');
                $('form[name="formCurrency"]').trigger("reset");
            }
        });
    });

    /***
     * Abre popup para confirmar exclusão de Currency
     */
    $("#deleteCurrencyModal").on('shown.bs.modal', function (event) {
        var caller = $(event.relatedTarget);
        var currencyName = caller.data('currency');
        var currencyId = caller.data('id');
        var modal = $(this);
        modal.find('.modal-body h5').text("Are you sure to delete \"" + currencyName + "\" currency?");
        modal.find('.modal-footer .delete-currency').attr("data-id", currencyId);
    });

    /***
     * Envia dados para exclusão de Currency
     */
    $('.delete-currency').click(function(){
        let id = $(this).data("id");
        
        let url = url_base.replace(":id", id);
        console.log(url);

        $.ajax({
            url: url,
            type: "delete",
            data: {"_token": "{{ csrf_token() }}"},
            dataType: "json",
            success: function(response){
                message(response, ".table");
                $("#deleteCurrencyModal").modal('toggle');
            }
        });        
    });
</script>