// Código para la rotación de imágenes
const collageItems = document.querySelectorAll('.collage-item');

let currentIndex = 0; // Comienza desde la 5ta imagen (índice 4)

function rotateImages() {
    if (images.length === 0) return; // No hacer nada si no hay imágenes

    collageItems.forEach((item, index) => {
        const img = item.querySelector('img');
        if (img) {
            // Asignar la imagen correspondiente al índice actual
            img.src = images[(currentIndex + index) % images.length];
        }
    });

    // Incrementar el índice actual
    currentIndex = (currentIndex + 1) % images.length;

    // Programar la siguiente rotación
    setTimeout(rotateImages, 5000); // Rotar cada 5 segundos
}

// Ejecutar la rotación inicial al cargar la página
rotateImages();

// Código para el movimiento del apartado de "Bienvenidos"
const welcomeContent = document.getElementById('welcome-content');
let direction = 1; // Dirección del movimiento (1 = abajo, -1 = arriba)
const speed = 1; // Velocidad de movimiento (píxeles por frame)
const amplitude = 50; // Amplitud del movimiento (cuánto sube y baja)

let initialY = welcomeContent.offsetTop; // Posición inicial en Y
let animationFrameId = null; // ID del frame de animación

function moveWelcomeContent() {
    // Obtén la posición actual en Y
    let currentY = parseFloat(welcomeContent.style.top) || initialY;

    // Calcula la nueva posición en Y
    currentY += speed * direction;

    // Cambia la dirección si alcanza los límites
    if (currentY > initialY + amplitude || currentY < initialY - amplitude) {
        direction *= -1; // Cambia la dirección
    }

    // Aplica la nueva posición
    welcomeContent.style.top = `${currentY}px`;

    // Continúa la animación
    animationFrameId = requestAnimationFrame(moveWelcomeContent);
}