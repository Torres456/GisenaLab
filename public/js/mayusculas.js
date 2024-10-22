//Primer letra en mayuscula
function mayuscula(e) {
  e.value = e.value.charAt(0).toUpperCase() + e.value.slice(1);
}

const checkbox = document.getElementById('viwCategory');
const contentDiv = document.getElementById('newCategory');
const buttonCheck = document.getElementById('buttoncheck');

