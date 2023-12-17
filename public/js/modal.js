/***
 * Define o Foco no primeiro elemento .form-control do Modal
 */
$(".modal").on('shown.bs.modal', function (event) {
  let field = $(this).find(".form-control")[0];
  $(field).trigger("focus");
});

/***
 * Preenche informações da popup de confirmação de exclusão
 */
$(".modal-delete").on('shown.bs.modal', function (event) {
  let caller = $(event.relatedTarget);
  let name = caller.data('name');
  let id = caller.data('id');
  let modal = $(this);
  modal.find('.modal-body .name-to-delete').text(name);
  modal.find('.modal-footer .btn-danger').attr("data-id", id);
});

/***
 * Preenche os campos do formulário da popup de edição
 */
$(".modal-edit").on('shown.bs.modal', function (event) {
  let modal = $(this);
  $.each($(event.relatedTarget).data(), function (name, value) {
    setFieldValue(modal, name, value);
  });
});

/***
 * Preenche o campo do formulário de acordo com seu tipo
 */
function setFieldValue(form, fieldName, fieldValue) {
  let field = form.find("[name='" + fieldName + "']");
  console.log(field);
  switch (field.prop('tagName')) {
    case 'SELECT':
      field.children().each(function () {
        $(this).prop("selected", false);
        if ($(this).attr("value") == fieldValue)
          $(this).prop("selected", true);
      });
      break;
    case 'INPUT':
      switch (field.prop('type')) {
        case 'checkbox':
        case 'radio':
          field.prop("checked", false);
          if (fieldValue)
            field.prop("checked", true);
          break;
        default:
          field.val(fieldValue);
      }
    default:
      break;
  }
}