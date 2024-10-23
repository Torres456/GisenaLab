const Checkbox = document.getElementById('Changeselect');
const subChange = document.getElementById('subChange');
const slectInput = document.getElementById('categorySelect');
const SubcategorySelect = document.getElementById('SubcategorySelect');
const selectCategory = document.getElementById('selectCategory');
const subcategoryName = document.getElementById('subcategoryName');
const subcategoryName1 = document.getElementById('subcategoryName1');
const nameCategoy = document.getElementById('nameCategoy');
const descriptionCategory = document.getElementById('descriptionCategory');

//mandar a primera opcion select al activar checkbox
Checkbox.addEventListener('change', function () {
  if (this.checked) {
    //valor 1 a select
    slectInput.value = '';
    SubcategorySelect.value = '';
    SubcategorySelect.innerHTML = '<option value="">Seleccione una subcategoría</option>';
    subcategoryName.value = '';
    subcategoryName1.value = '';
    descriptionCategory.value = '';
    nameCategoy.value = '';
  }
});



subChange.addEventListener('change', function () {
    if (this.checked) {
      //valor 1 a select
      SubcategorySelect.value = '';
      subcategoryName1.value = '';
    }
  });

