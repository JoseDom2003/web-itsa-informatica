// Código para la rotación de imágenes
const collageItems = document.querySelectorAll('.collage-item');
const images = [
    "imagenes/image1.jpeg",
    "imagenes/image2.jpeg",
    "imagenes/image3.jpeg",
    "imagenes/image4.jpeg",
    "imagenes/image5.jpeg", // Imágenes adicionales para rotación
    "imagenes/image9.jpeg",
    "imagenes/image7.jpeg",
    "imagenes/image8.jpeg"
];

let currentIndex = 7; // Comienza desde la 5ta imagen (índice 4)

function rotateImages() {
    collageItems.forEach((item, index) => {
        const img = item.querySelector('img');
        img.src = images[(currentIndex + index) % images.length];
    });

    currentIndex = (currentIndex + 1) % images.length;
}

// Cambia las imágenes cada 2 segundos
setInterval(rotateImages, 2000);

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

// Inicia la animación cuando el mouse entra
welcomeContent.addEventListener('mouseenter', () => {
    if (!animationFrameId) { // Evita múltiples animaciones
        moveWelcomeContent();
    }
});

// Detiene la animación cuando el mouse sale
welcomeContent.addEventListener('mouseleave', () => {
    if (animationFrameId) {
        cancelAnimationFrame(animationFrameId); // Detiene la animación
        animationFrameId = null; // Reinicia el ID
        welcomeContent.style.top = `${initialY}px`; // Vuelve a la posición inicial
    }
});