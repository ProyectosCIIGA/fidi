// Obtener el parámetro 'cuenta' de la URL
const urlParams = new URLSearchParams(window.location.search);
const cuenta = urlParams.get('cta');

// Verificar si se proporcionó la cuenta en la URL
if (cuenta) {
  const bd = 'implementtaTolucaP';
  consultarFotos(cuenta, bd);
}

function consultarFotos(cuenta, bd) {
  $.ajax({
    url: 'php/UrlImage.php', // Ruta del servidor donde se procesará la solicitud
    method: 'GET',
    data: { cuenta, bd },
    success: function (response) {
      // Convertir la respuesta JSON en un objeto JavaScript
      const urls = response;

      // Generar botones para cada URL de imagen
      for (let i = 0; i < urls.length; i++) {
        const url = urls[i].urlS3;
        generarBoton(url, i + 1);
      }

      // Cambiar la imagen con la primera URL obtenida
      cambiarImagen(urls[0].urlS3);
    },
    error: function () {
      Swal.fire({
        icon: 'error',
        title: 'Error al consultar datos',
      });
    },
    beforeSend: function () {
      Swal.fire({
        title: 'Obteniendo Datos',
        html: 'Espere un momento por favor...',
        timer: 0,
        timerProgressBar: true,
        allowEscapeKey: false,
        allowOutsideClick: false,
        didOpen: () => {
          Swal.showLoading();
        },
        willClose: () => {
          return false;
        }
      });
    },
    complete: function () {
      Swal.close();
    }
  });
}

function generarBoton(url, indice) {
  const contenedorBotones = document.getElementById('contenedor-botones');

  // Crear el elemento <button> y agregar las clases correspondientes
  const btn = document.createElement('button');
  btn.classList.add('btn', 'photos', 'swing-animation');
  btn.textContent = `Imagen ${indice}`;
  // Crear el elemento <i> para el ícono y agregar las clases
  const icono = document.createElement('i');
  icono.classList.add('fa', 'fa-camera', 'p-1');
  btn.appendChild(icono);

  // Agregar el evento de clic al botón
  btn.addEventListener('click', function () {
    // Mostrar el mensaje de carga con SweetAlert2
    Swal.fire({
      title: 'Obteniendo imagen',
      html: 'Espere un momento por favor...',
      timer: 0,
      timerProgressBar: true,
      allowEscapeKey: false,
      allowOutsideClick: false,
      didOpen: () => {
        Swal.showLoading();
      }
    });
    cambiarImagen(url);
  });

  // Agregar el botón al contenedor de botones
  contenedorBotones.appendChild(btn);
}

function cambiarImagen(rutaImagen) {
  var image = document.getElementById('image');
  // Simulación de tiempo de carga 
  setTimeout(function () {
    image.src = rutaImagen;
    // Cerrar SweetAlert2 cuando termine de cargar la imagen
    Swal.close();
  }, 1500); // Tiempo de carga simulado (en milisegundos)
}
