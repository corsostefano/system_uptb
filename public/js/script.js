//Transformar texto ingresado del campo name_rol a mayúsculas

const inputElement =document.getElementById('name_rol');

inputElement.addEventListener('input', function() {
    this.value = this.value.toUpperCase()
})

//Confirmación de eliminación de roles
function confirmDeletion(event, form) {
    event.preventDefault(); 

    
    Swal.fire({
        title: '¿Deseas Eliminar el Registro?',
        text: "¡No podrás revertir esto!",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, borrar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit(); 
        }
    });
}

