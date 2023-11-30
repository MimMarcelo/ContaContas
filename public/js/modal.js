const myAlert = document.getElementById('message-box')
myAlert.addEventListener('close.bs.alert', event => {
  event.preventDefault();
  document.getElementById('message-box').classList.add("d-none");
});

const myModal = document.getElementById('myModal')
const myInput = document.getElementsByClassName('form-focus')[0];
//const btnAdd = document.getElementById('add')

if(isNaN(myModal))
  myModal.addEventListener('shown.bs.modal', () => {
    myInput.focus()
  })

// window.onkeyup = function(e){
//   console.log(btnAdd);
//   if(btnAdd == null){
//     return
//   }
//   if(e.ctrlkey && e.key === "n"){
//     btnAdd.click()
//   }
// }