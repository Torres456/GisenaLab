//Primer letra en mayuscula
function mayuscula(e) {
    e.value = e.value.charAt(0).toUpperCase() + e.value.slice(1);
}

const checkbox = document.getElementById('viwCategory');
const contentDiv = document.getElementById('newCategory');

// Inicialmente, el div está oculto
contentDiv.style.display = 'none';

  // Escucha el cambio en el checkbox
  checkbox.addEventListener('change', () => {
    if (checkbox.checked) {
      contentDiv.style.display = 'block';  // Mostrar el div
    } else {
      contentDiv.style.display = 'none';  // Ocultar el div
    }
  });