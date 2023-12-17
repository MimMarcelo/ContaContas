<script>
    //Define a URL para deletar e editar
    let url_destroy = "{{ route('sources.destroy', ':id') }}";
    let url_update = "{{ route('sources.update', ':id') }}";

    /***
     * Envia dados para salvar Source
     */
    $('form[name="formCreateSource"]').submit(function(e) {
        e.preventDefault();
        let modal = $(this).parents(".modal");
        let form = $(this);

        $.ajax({
            url: "{{ route('sources.store') }}",
            type: "post",
            data: $(this).serialize(),
            dataType: "json",
            success: function(response) {
                message(response, ".table");
                $(modal).modal('toggle');
                $(form).trigger("reset");
            }
        });
    });

    /***
     * Envia dados para editar Source
     */
    $('form[name="formEditSource"]').submit(function(e) {
        e.preventDefault();
        let modal = $(this).parents(".modal");
        let id = $(this).find('input[name="id"]').val();

        let url = url_update.replace(":id", id);

        $.ajax({
            url: url,
            type: "put",
            data: $(this).serialize(),
            dataType: "json",
            success: function(response) {
                console.log(response.obj);
                message(response, ".table");
                $(modal).modal('toggle');
            }
        });
    });

    /***
     * Envia dados para exclusão
     */
    $('.delete-source').click(function() {
        let id = $(this).attr("data-id");
        let modal = $(this).parents(".modal");

        let url = url_destroy.replace(":id", id);

        $.ajax({
            url: url,
            type: "delete",
            data: {
                "_token": "{{ csrf_token() }}"
            },
            dataType: "json",
            success: function(response) {
                message(response, ".table");
                $(modal).modal('toggle');
            }
        });
    });
</script>
