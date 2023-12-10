<script>
    //Define a URL para deletar e editar
    let url_destroy = "{{ route('sources.destroy', ':id') }}";
    let url_update = "{{ route('sources.update', ':id') }}";

    /***
     * Envia dados para salvar
     */
    $('form[name="formCreateSource"]').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: "{{ route('sources.store') }}",
            type: "post",
            data: $(this).serialize(),
            dataType: "json",
            success: function(response) {
                message(response, ".table");
                $("#createSourceModal").modal('toggle');
                $('form[name="formCreateSource"]').trigger("reset");
            }
        });
    });

    /***
     * Abre popup para editar Currency
     */
    // $("#editCurrencyModal").on('shown.bs.modal', function(event) {
    //     let caller = $(event.relatedTarget);
    //     let fields = ['name', 'code', 'id'];
    //     let modal = $(this);
    //     let checkbox = modal.find('input:checkbox');

    //     $(checkbox).prop("checked", false);

    //     fields.forEach(f => {
    //         modal.find('input[name="' + f + '"]').val(caller.data(f));
    //     });

    //     if (caller.data("default")) {
    //         $(checkbox).prop("checked", true);
    //     }
    // });

    /***
     * Envia dados para edição de Currency
     */
    // $('form[name="formEditCurrency"]').submit(function(e) {
    //     e.preventDefault();

    //     let id = $(this).find('input[name="id"]').val();

    //     let url = url_update.replace(":id", id);

    //     $.ajax({
    //         url: url,
    //         type: "put",
    //         data: $(this).serialize(),
    //         dataType: "json",
    //         success: function(response) {
    //             console.log(response.obj);
    //             message(response, ".table");
    //             $("#editCurrencyModal").modal('toggle');
    //         }
    //     });
    // });

    /***
     * Abre popup para confirmar exclusão de Currency
     */
    $("#deleteSourceModal").on('shown.bs.modal', function(event) {
        let caller = $(event.relatedTarget);
        let name = caller.data('name');
        let id = caller.data('id');
        let modal = $(this);
        modal.find('.modal-body h5').text("Are you sure to delete \"" + name + "\" source?");
        modal.find('.modal-footer .delete-source').attr("data-id", id);
    });

    /***
     * Envia dados para exclusão
     */
    $('.delete-source').click(function() {
        let id = $(this).attr("data-id");

        let url = url_destroy.replace(":id", id);
        console.log(url);

        $.ajax({
            url: url,
            type: "delete",
            data: {
                "_token": "{{ csrf_token() }}"
            },
            dataType: "json",
            success: function(response) {
                message(response, ".table");
                $("#deleteSourceModal").modal('toggle');
            }
        });
    });
</script>
