// Función para mostrar la sección seleccionada y ocultar las demás
function mostrarSeccion(seccionId, evt) {
  if (evt) evt.preventDefault();

  // Oculta el contenido principal
  const contenidoPrincipal = document.getElementById('contenido-principal');
  if (contenidoPrincipal) {
    contenidoPrincipal.classList.add('d-none');
  }

  // Oculta todas las secciones configuradas
  document.querySelectorAll('[id^="config-"]').forEach(div => {
    div.classList.add('d-none');
  });

  // Muestra la sección seleccionada
  const seccionActiva = document.getElementById(seccionId);
  console.log('elemento encontrado:', seccionActiva);
  if (seccionActiva) {
    seccionActiva.classList.remove('d-none');
    // Hacer scroll al contenido mostrado
    seccionActiva.scrollIntoView({ behavior: 'smooth', block: 'start' });
  } else {
    console.error(`La sección con ID "${seccionId}" no existe.`);
  }
}

// Función para volver al contenido principal
function mostrarPrincipal(evt) {
  if (evt) evt.preventDefault();

  document.getElementById('contenido-principal').classList.remove('d-none');
  document.querySelectorAll('[id^="config-"]').forEach(div => {
    div.classList.add('d-none');
  });
}

// Toggle de collapse de Layouts
function toggleLayouts() {
  const el = document.getElementById('layoutsCollapse');
  let bs = bootstrap.Collapse.getInstance(el);
  if (!bs) bs = new bootstrap.Collapse(el, { toggle: false });
  bs.toggle();
}

// Toggle de sidebar
document.getElementById('toggleSidebar').addEventListener('click', () => {
  document.getElementById('sidebar').classList.toggle('sidebar-hidden');
});