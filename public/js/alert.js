/***
 * Referência para a caixa de alerta do sistema
 */
const myAlert = document.getElementById('message-box');

/***
 * Evita que a caixa de alerta seja removida do DOM
 */
myAlert.addEventListener('close.bs.alert', event => {
  event.preventDefault();
  document.getElementById('message-box').classList.add("d-none");
});

/***
 * Seta a mensagem e a cor da caixa de alerta
 * Também especifica qual elemento deve ser atualizado (AJAX)
 */
function message(response, update){
  $("#message-box").removeClass('d-none');
  $("#message").text(response.message);
  if(response.success){
      $("#message-box").removeClass('alert-danger');
      $("#message-box").addClass('alert-success');
      $(update).load(location.href + " " + update);
  }
  else{
      $("#message-box").removeClass('alert-success');
      $("#message-box").addClass('alert-danger');
  }
}
