//Transformar texto ingresado del campo name_rol a mayúsculas

const inputElement =document.getElementById('name_rol');

inputElement.addEventListener('input', function() {
    this.value = this.value.toUpperCase()
})
