const myModal = document.getElementById('myModal')
const myInput = document.getElementsByClassName('form-focus')[0];

myModal.addEventListener('shown.bs.modal', () => {
  myInput.focus()
})
