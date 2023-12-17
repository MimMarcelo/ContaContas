<script>
    //Define a URL para deletar Currency
    let url_destroy = "{{route('currencies.destroy', ':id')}}";
    let url_update = "{{route('currencies.update', ':id')}}";

    /***
     * Envia dados para salvar Currency
     */
    $('form[name="formCurrency"]').submit(function(e){
        e.preventDefault();
        let modal = $(this).parents(".modal");
        let form = $(this);
        $.ajax({
            url: "{{route('currencies.store')}}",
            type: "post",
            data: $(this).serialize(),
            dataType: "json",
            success: function(response){
                message(response, ".table");
                $(modal).modal('toggle');
                $(form).trigger("reset");
            }
        });
    });
    
    /***
     * Envia dados para editar de Currency
     */
     $('form[name="formEditCurrency"]').submit(function(e){
        e.preventDefault();
        let modal = $(this).parents(".modal");
        let id = $(this).find('input[name="id"]').val();
        
        let url = url_update.replace(":id", id);

        $.ajax({
            url: url,
            type: "put",
            data: $(this).serialize(),
            dataType: "json",
            success: function(response){
                message(response, ".table");
                $(modal).modal('toggle');
            }
        });        
    });

    /***
     * Envia dados para excluir Currency
     */
    $('.delete-currency').click(function(){
        let id = $(this).attr("data-id");
        let modal = $(this).parents(".modal");
        
        let url = url_destroy.replace(":id", id);
        
        $.ajax({
            url: url,
            type: "delete",
            data: {"_token": "{{ csrf_token() }}"},
            dataType: "json",
            success: function(response){
                message(response, ".table");
                $(modal).modal('toggle');
            }
        });        
    });
</script>