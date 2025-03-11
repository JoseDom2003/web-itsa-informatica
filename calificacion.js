// Seleccionar elementos del DOM
const estrellas = document.querySelector('.estrellas');
const valorPuntuacion = document.getElementById('valor-puntuacion');
const formulario = document.getElementById('formulario-comentarios');
const emailInput = document.getElementById('email');
const emailError = document.getElementById('email-error');
const comentarioError = document.getElementById('comentario-error');

// Función para manejar la selección de estrellas usando delegación de eventos
estrellas.addEventListener('click', (e) => {
    if (e.target.tagName.toLowerCase() === 'span') {
        const valor = e.target.getAttribute('data-value'); // Obtener el valor de la estrella clickeada
        valorPuntuacion.textContent = valor; // Mostrar el valor seleccionado

        // Remover la clase 'active' de todas las estrellas
        document.querySelectorAll('.estrellas span').forEach((e) => e.classList.remove('active'));

        // Añadir la clase 'active' a las estrellas seleccionadas
        for (let i = 0; i < valor; i++) {
            document.querySelectorAll('.estrellas span')[i].classList.add('active');
        }
    }
});

// Función para validar el formulario
formulario.addEventListener('submit', (e) => {
    e.preventDefault(); // Evitar el envío del formulario por defecto

    // Validar correo electrónico
    const email = emailInput.value.trim();
    const isValidEmail = validateEmail(email);
    emailError.style.display = isValidEmail ? 'none' : 'block'; // Mostrar error si el email es inválido

    // Validar comentario
    const comentario = document.getElementById('comentario').value.trim();
    comentarioError.style.display = comentario === '' ? 'block' : 'none'; // Mostrar error si el comentario está vacío

    // Si ambas validaciones son correctas, enviar el formulario
    if (isValidEmail && comentario !== '') {
        // Feedback visual de éxito
        const successMessage = document.createElement('div');
        successMessage.textContent = '¡Gracias por tu comentario!';
        successMessage.classList.add('success-message');
        formulario.prepend(successMessage); // Mostrar mensaje al principio del formulario

        // Limpiar formulario
        formulario.reset();
        valorPuntuacion.textContent = '0'; // Reiniciar la puntuación
        document.querySelectorAll('.estrellas span').forEach((e) => e.classList.remove('active')); // Reiniciar estrellas
    }
});

// Función para validar el correo electrónico
function validateEmail(email) {
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regex.test(email);
}

// Scroll suave para enlaces del menú
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});
