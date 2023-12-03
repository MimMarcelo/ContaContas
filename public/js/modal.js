/***
 * Define o Foco no primeiro elemento .form-control do Modal
 */
$(".modal").on('shown.bs.modal', function (event) {
  let field = $(this).find(".form-control")[0];
  $(field).trigger("focus");
});