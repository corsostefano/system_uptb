document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("resetPasswordForm");
    
    form.addEventListener("submit", function (event) {
        // Obtener los valores de los campos de contraseña
        const password = document.getElementById("new_password").value;
        const confirmPassword = document.getElementById("confirm_password").value;

        // Verificar si las contraseñas coinciden
        if (password !== confirmPassword) {
            // Prevenir el envío del formulario
            event.preventDefault();

            // Mostrar alerta de error
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Las contraseñas no coinciden. Por favor, inténtelo de nuevo."
            });
        }
    });
});