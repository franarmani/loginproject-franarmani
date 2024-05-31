// Este script manejará la funcionalidad de alternar la visibilidad de la contraseña en los campos de contraseña.

function togglePasswordVisibility(inputId) {
    var passwordInput = document.getElementById(inputId);
    var toggleIcon = document.querySelector('.toggle-password');

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye');
    } else {
        passwordInput.type = "password";
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash');
    }
}
