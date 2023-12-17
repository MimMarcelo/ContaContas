<script>
  //Define a URL para deletar e editar
  let url_destroy = "{{ route('bills.destroy', ':id') }}";
  let url_update = "{{ route('bills.update', ':id') }}";

  /***
   * Envia dados para salvar Bill
   */
  $('form[name="formCreateBill"]').submit(function(e) {
      e.preventDefault();
      let modal = $(this).parents(".modal");
      let form = $(this);

      $.ajax({
          url: "{{ route('bills.store') }}",
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
   * Envia dados para editar Bill
   */
  $('form[name="formEditBill"]').submit(function(e) {
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
  $('.delete-bill').click(function() {
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
