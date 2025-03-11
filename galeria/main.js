function downloadImage(imgElement) {
    // Crear un enlace temporal para la descarga
    const link = document.createElement('a');
    link.href = imgElement.src; // Usar la URL de la imagen
    link.download = imgElement.alt || 'image'; // El nombre del archivo será el atributo 'alt' de la imagen
    link.click(); // Simula un clic en el enlace
}
