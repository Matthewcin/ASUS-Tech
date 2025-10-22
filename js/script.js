const diapositivas = document.querySelectorAll(".diapositiva");
let indiceDiapositiva = 0;

// Mostrar diapositiva activa
function mostrarDiapositiva(n) {
  diapositivas.forEach((d, i) => d.classList.toggle("activa", i === n));
  indiceDiapositiva = n;
}

// Inicializar en la primera
mostrarDiapositiva(indiceDiapositiva);

// Cambio automático cada 4 segundos
setInterval(() => {
  let siguiente = (indiceDiapositiva + 1) % diapositivas.length;
  mostrarDiapositiva(siguiente);
}, 4000);
