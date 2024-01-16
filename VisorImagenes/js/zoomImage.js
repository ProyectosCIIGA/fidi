var container = document.getElementById('container');
var image = document.getElementById('image');
var isDragging = false;
var startX, startY, currentX, currentY;
var deltaX = 0;
var deltaY = 0;
var friction = 0.95; /* Ajusta el valor para controlar la "inercia" del arrastre */

container.addEventListener('mousedown', function (e) {
  isDragging = true;
  startX = e.clientX - deltaX;
  startY = e.clientY - deltaY;
  container.style.cursor = 'grabbing';
  image.style.transition = 'none';
});

document.addEventListener('mouseup', function () {
  isDragging = false;
  container.style.cursor = 'grab';
});

document.addEventListener('mousemove', function (e) {
  if (isDragging) {
    e.preventDefault();
    currentX = e.clientX;
    currentY = e.clientY;
    deltaX = currentX - startX;
    deltaY = currentY - startY;

    image.style.transform = `translate(${deltaX}px, ${deltaY}px)`;
  }
});

/* Función para aplicar la "inercia" del arrastre */
// function inertiaScroll() {
//   if (!isDragging && (Math.abs(deltaX) > 1 || Math.abs(deltaY) > 1)) {
//     deltaX *= friction;
//     deltaY *= friction;
//     image.style.transform = `translate(${deltaX}px, ${deltaY}px)`;
//     requestAnimationFrame(inertiaScroll);
//   }
// }

/* Llamamos a la función inertiaScroll para aplicar el efecto inercial */
// document.addEventListener('mouseup', inertiaScroll);
document.addEventListener('mouseup');
var initialWidth; // Variable para almacenar el ancho inicial de la imagen

function zoomIn() {
  var imagen = document.getElementById("image");
  var currentWidth = imagen.offsetWidth;
  imagen.style.width = currentWidth * 1.2 + "px";
}

function zoomOut() {
  var imagen = document.getElementById("image");
  var currentWidth = imagen.offsetWidth;

  if (!initialWidth) {
    initialWidth = currentWidth;
  }

  if (currentWidth >= initialWidth) {
    imagen.style.width = currentWidth / 1.2 + "px";
  }
}
