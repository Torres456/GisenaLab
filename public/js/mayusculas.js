//Primer letra en mayuscula
function mayuscula(e) {
  e.value = e.value.charAt(0).toUpperCase() + e.value.slice(1);
}

const Checkbox = document.getElementById('Changeselect');
const slectInput = document.getElementById('categorySelect');
const selectCategory = document.getElementById('selectCategory')

//mandar a primera opcion select al activar checkbox
Checkbox.addEventListener('change', function () {
  if (this.checked) {
    //valor 1 a select
    slectInput.value = '';
  }
});

