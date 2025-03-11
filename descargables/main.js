// Funcionalidad de búsqueda de plantillas (Ejemplo: si agregas un input de búsqueda con id="searchInput")
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
      searchInput.addEventListener('keyup', function () {
        const query = searchInput.value.toLowerCase();
        const cards = document.querySelectorAll('.card');
        cards.forEach((card) => {
          const title = card.querySelector('.card-title').textContent.toLowerCase();
          card.parentElement.style.display = title.includes(query) ? '' : 'none';
        });
      });
    }
  });
  