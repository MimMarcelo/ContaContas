<script>
    //Define a URL para deletar Currency
    let url_destroy = "{{route('currencies.destroy', ':id')}}";
    let url_update = "{{route('currencies.update', ':id')}}";

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
     * Abre popup para editar Currency
     */
     $("#editCurrencyModal").on('shown.bs.modal', function (event) {
        let caller = $(event.relatedTarget);
        let fields = ['name', 'code', 'id'];
        let modal = $(this);
        let checkbox = modal.find('input:checkbox');

        $(checkbox).prop("checked", false);
        
        fields.forEach(f => {
            modal.find('input[name="'+f+'"]').val(caller.data(f));
        });
        
        if(caller.data("default")){
            $(checkbox).prop("checked", true);
        }
    });

    /***
     * Envia dados para edição de Currency
     */
     $('form[name="formEditCurrency"]').submit(function(e){
        e.preventDefault();
        
        let id = $(this).find('input[name="id"]').val();
        
        let url = url_update.replace(":id", id);

        $.ajax({
            url: url,
            type: "put",
            data: $(this).serialize(),
            dataType: "json",
            success: function(response){
                console.log(response.obj);
                message(response, ".table");
                $("#editCurrencyModal").modal('toggle');
            }
        });        
    });

    /***
     * Abre popup para confirmar exclusão de Currency
     */
    $("#deleteCurrencyModal").on('shown.bs.modal', function (event) {
        let caller = $(event.relatedTarget);
        let currencyName = caller.data('currency');
        let currencyId = caller.data('id');
        let modal = $(this);
        modal.find('.modal-body h5').text("Are you sure to delete \"" + currencyName + "\" currency?");
        modal.find('.modal-footer .delete-currency').attr("data-id", currencyId);
    });

    /***
     * Envia dados para exclusão de Currency
     */
    $('.delete-currency').click(function(){
        let id = $(this).attr("data-id");
        
        let url = url_destroy.replace(":id", id);
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