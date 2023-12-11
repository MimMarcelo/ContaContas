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
    $("#editSourceModal").on('shown.bs.modal', function(event) {
        let caller = $(event.relatedTarget);
        let fields = ['name', 'code', 'group', 'currency', 'id'];
        let checks = ['cc', 'resume'];
        let modal = $(this);

        fields.forEach(f => {
          modal.find('input[name="' + f + '"]').val(caller.data(f));
        });

        //Limpa marcação dos checkboxes
        modal.find('input:checkbox').prop("checked", false);
        checks.forEach(f => {
          if(caller.data(f)) 
            modal.find('input[name="' + f + '"]').prop("checked", true);
        });

        if(modal.has("select")){
          let select = modal.find("select");
          select.children().each(function(){
            $(this).prop("selected", false);
            if($(this).attr("value") == caller.data("currency")){
              $(this).prop("selected", true);
            }
          });
        }
    });

    /***
     * Envia dados para edição de Currency
     */
    $('form[name="formEditSource"]').submit(function(e) {
        e.preventDefault();

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
                $("#editSourceModal").modal('toggle');
            }
        });
    });

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
